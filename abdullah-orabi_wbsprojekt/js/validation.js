// was will ich hiermachen wenn 
// Cleient side validation für mein Ziele und Meilensteine
// warum keinahung vielleich ist es erforderlich wie ich verstanden habe von Mike und es hilft mir diese Problem zu lösen die ich gerade habe 

// was soll gemacht werden 
// na ja ich brauch ein Hlep function der mir Ziel/ Meilenstein Name validert und ensprichen Fehler ausgibt

// OK
function createError(element,errorMessage)
{
  const errorDiv = document.createElement('div');

  // Set the error message and styling
  errorDiv.textContent = errorMessage;
  errorDiv.style.color = 'red';
  errorDiv.style.fontSize = '1.5rem';
  errorDiv.style.margin = '0.5rem';
  errorDiv.classList.add("error")
  // Insert the error div after the input element in the DOM
  element.parentNode.insertBefore(errorDiv, element.nextSibling);
}
function nameValidaton(name, errors)
{
  // wenn der name leer ist
  if(name == '' || name == undefined || name == null)
    errors['name-error'] = "Name darf nicht leer sein";

  // name soll zumindest zwei wörter haben
  const words = name.split(" ");
  if(words.length < 2)
  {
    errors['name-error'] = "Name soll mindisten Zwei Wörter beinthalten";
  }
}

function dateValidation(startDate, endDate, errors)
{
  // Der Start sowie der End Datum sollen nicht im Vergangenheit legen
  const unixStartDate = Date.parse(startDate) / 1000;
  const unixEndDate = Date.parse(endDate) / 1000; 
  const currentDate = new Date().getTime() / 10001;

  if(currentDate > unixStartDate)
    errors['start-date-error'] = "Start Datum kann nicht im Vergangenheit legen";
  if(currentDate > unixEndDate)
    errors['end-date-error'] = "End Datum kann nicht im Vergangenheit legen";
  if(unixStartDate > unixEndDate)
    errors['end-date-error'] = "End Datum liegt vor das Start Datum";
}

// was brauchen wir ??? 
// wir brauchen 
// 1 addeventlistner to my submit button 
// wenn das passiert dann hole die daten von die inputs 
// validere die Daten
const goalForm = document.querySelector('.goal-form');

// Ziel From Validation 
goalForm.addEventListener('submit', function(event)
{
  const goalName = document.getElementById("zielname");
  const startDate = document.getElementById("startdatum");
  const endDate = document.getElementById("enddatum");

  nameValidaton(goalName.value, errors);
  dateValidation(startDate.value,endDate.value,errors);

  //erstens vorherige errorDivs löschen 
  const errorDivs = document.querySelectorAll('.error');
    errorDivs.forEach(div => {
    div.remove();
  });

  if (Object.keys(errors).length !== 0)
  {
    event.preventDefault();
    if(errors['name-error'] != '')
      createError(goalName,errors['name-error']);

    if(errors['start-date-error'] != '')
      createError(startDate,errors['start-date-error']);

    if(errors['start-date-error'] != '')
      createError(endDate,errors['end-date-error']);
    
  }
  errors = {};
});


// Meilenstein From Validation 
const milestoneForm = document.querySelector('.milestone-form');
milestoneForm.addEventListener('submit', function(event)
{
  const milestoneName = document.getElementById("MeilensteinName");
  const startDate = document.getElementById("startdatum");
  const endDate = document.getElementById("enddatum");

  nameValidaton(milestoneName.value, errors);
  dateValidation(startDate.value,endDate.value,errors);

  //erstens vorherige errorDivs löschen 
  const errorDivs = document.querySelectorAll('.error');
    errorDivs.forEach(div => {
    div.remove();
  });

  if (Object.keys(errors).length !== 0)
  {
    event.preventDefault();
    if(errors['name-error'] != '')
      createError(milestoneName,errors['name-error']);

    if(errors['start-date-error'] != '')
      createError(startDate,errors['start-date-error']);

    if(errors['start-date-error'] != '')
      createError(endDate,errors['end-date-error']);
    
  }
  errors = {};
});

errors = {};

