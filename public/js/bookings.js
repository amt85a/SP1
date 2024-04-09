let currentStep = 1
nextBtn = document.getElementById("nextBtn")
prevBtn = document.getElementById("prevBtn")
step1 = document.getElementById("step1")
step2 = document.getElementById("step2")
step3 = document.getElementById("step3")
step2.style.display = "none";
step3.style.display = "none";
prevBtn.style.display = "none";


function showNextStep(number) {
    currentStep = currentStep + number
    if (currentStep === 2) {
        step1.style.display = "none"
        step2.style.display = "block"
        prevBtn.style.display = "block"
    }
    if (currentStep === 3) {
        step2.style.display = "none"
        step3.style.display = "block"
    }
}

function showPreviousStep(number) {
    currentStep = currentStep - number
    if (currentStep === 2) {
        step1.style.display = "none"
        step2.style.display = "block"
    }
    if (currentStep === 1) {
        step1.style.display = "block"
        step2.style.display = "none"
        prevBtn.style.display = "none"
    }
}
