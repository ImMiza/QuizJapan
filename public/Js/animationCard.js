let finish = false;
let cards = document.getElementsByClassName("border_card");

Array.from(cards).forEach((element) => {
    element.addEventListener("mouseenter", mouseOver);
    element.addEventListener("mouseleave", mouseOut);
    element.addEventListener("click", answer);
});

function mouseOver(event) {
    if(finish === false) {
        event.target.className = "card pointeurCarte border-success bg-success text-white mb-3";
    }
}

function mouseOut(event) {
    if(finish === false) {
        event.target.className = "card pointeurCarte border-primary mb-3 border_card text-primary";
    }
}

function answer(event) {
    var win = undefined;
    Array.from(cards).forEach((element) => {
        element.className = "card pointeurCarte p-3 mb-2 bg-warning text-dark border_card";
        element.removeEventListener("click", answer);
        element.removeEventListener("mouseenter", mouseOver);
        element.removeEventListener("mouseleave", mouseOut);

        if(element === event.target || element.contains(event.target)) {
            win = element;
        }
    });
    if(win !== undefined) {
        win.className = "card pointeurCarte border-success bg-success text-white mb-3";
    }
    finish = true;
}
