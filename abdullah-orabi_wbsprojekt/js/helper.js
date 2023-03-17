// Wenn man auf new Meilenstein klickt soll Goal-id gespeichert werden um 
// später bei Meilenstein form als hidden input zu speichern.
// hintergrund eine Meilenstein gehört zu eine spezifischen Goal

const addMilestoneButtons = document.querySelectorAll('.addmilestone-button');

let goalID;

addMilestoneButtons.forEach((addmilestoneButton) =>
{
  addmilestoneButton.addEventListener("click", function()
  {
    goalID = addmilestoneButton.getAttribute("data-goalid");
  })
});

const addMilestoneForm = document.querySelector(".milestone-form");

addMilestoneForm.addEventListener('submit', (event) =>
{
  // event.preventDefault();
  // console.log(goalID);
  let hiddenInput = document.getElementById("goalid-input");
  hiddenInput.value = goalID;
});


// wenn checkbox für ein Meilensteind gecklickt wird soll dann ein Requist gesendet werden in dem man mit hife die folgenden code Den versteckten Submit Button klickt wenn der checkbox gecklickt wurde.

const milestoneCheckboxes = document.querySelectorAll(".checkbox");
milestoneCheckboxes.forEach((checkbox) =>{
  checkbox.addEventListener("click", function(){
    let submitbut = checkbox.nextElementSibling;
    console.log(submitbut);
    submitbut.click();
  });
});