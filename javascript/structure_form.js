const changeLabelBasedOnStructureType = structureType => {
  const labelReference = document.getElementById("participantNumber");
  if (structureType === "association") {
    labelReference.textContent = "Nombre de donateur(s)";
  } else {
    labelReference.textContent = "Nombre d'actionnair(s)";
  }
};

const handleRadioClick = element => {
  changeLabelBasedOnStructureType(element.value);
};

changeLabelBasedOnStructureType("<?= $structureType ?>");
console.log("loaded");
