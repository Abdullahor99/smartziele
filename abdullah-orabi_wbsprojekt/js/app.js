// Footer soll wenn die Seite nicht scrollbar ist ganz unten fixert sein

if (document.documentElement.scrollHeight <= document.documentElement.clientHeight)
{
  let footer = document.querySelector(".footer");
  footer.style.position = "fixed";
  footer.style.bottom = "0";
}
// #####################################################




// wenn man auf neu Ziel Button klickt soll Ziel anlegen form angezeigt werden. 
// wenn man außerhalb klickt soll die Form verschwidnen.
const addGoalbtn = document.querySelector(".addgoal-button");
const goalform = document.querySelector(".goal-form");
const goalformCont = document.querySelector(".goal-form-cont");

addGoalbtn.addEventListener("click", function () {
  goalformCont.style.display = "block";
});

goalformCont.addEventListener('click', function (event) {
  if (!goalform.contains(event.target)) {
    goalformCont.style.display = 'none';
  }
});
//########################################################

// wenn man auf neu Meilenstein Button klickt soll Meilenstein anlegen form angezeigt werden. 
// wenn man außerhalb klickt soll die Form verschwidnen.
const addMilestonebtn = document.querySelector(".addmilestone-button");
const milestoneform = document.querySelector(".milestone-form");
const milestoneFormCont = document.querySelector(".milestone-form-cont");

addMilestonebtn.addEventListener("click", function () {
  milestoneFormCont.style.display = "block";
});

milestoneFormCont.addEventListener('click', function (event) {
  if (!milestoneform.contains(event.target)) {
    milestoneFormCont.style.display = 'none';
  }
});
//########################################################