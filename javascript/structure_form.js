// ! Label structure type display management
const changeLabelBasedOnStructureType = structureType => {
  const labelReference = document.getElementById("participantNumber");
  if (structureType === "association") {
    labelReference.textContent = "Nombre de donateur(s)";
  } else {
    labelReference.textContent = "Nombre d'actionnaire(s)";
  }
};

const handleRadioClick = element => {
  changeLabelBasedOnStructureType(element.value);
};

changeLabelBasedOnStructureType("<?= $structureType ?>");

// ! Sector management

// * Récupération du prototype & du parent
const prototype = document.getElementById("prototype/__0__/");
const prototypeParent = prototype.parentElement;

// * Ajout d'un nouveau prototype
let btnAddSector = document.getElementById("btnAddSector");
btnAddSector.onclick = function() {
  console.log("cc");

  let newPrototype = prototype.cloneNode(true);
  prototypeParent.appendChild(newPrototype);
};

// * Remove d'un prototype
let iconRemoveSector = document.getElementById("iconRemoveSector");
iconRemoveSector.onclick = function() {
  this.parentElement.parentElement.remove();
};

function removeSector(element) {
  element.parentElement.parentElement.remove();
}
