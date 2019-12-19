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

// ? Form submit validation
function formValidate(e) {
  let sectors = document.getElementsByName("sector[]");

  if (sectors.length == 0) {
    alert("Veuillez renseigner au moins un secteur.");
    return false;
  }

  let sectorName = "";

  for (i = 0; i < sectors.length; i++) {
    if (sectorName == sectors[i].value) {
      alert("Veuillez renseigner une seule fois chaque secteur.");
      return false;
    } else {
      sectorName = sectors[i].value;
    }
  }

  let cp = document.getElementById("postalCode");
  if (cp.value.length != 5) {
    alert("Le code postal doit contenir exactement 5 chiffres.");
    return false;
  }

  return true;
}
