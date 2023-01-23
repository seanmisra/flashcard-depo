function clickCard(id) {
    let cardElem = document.getElementById(id);

    console.log(cardElem);

    if (cardElem) {
        let showSide = cardElem.getElementsByClassName('show-side')[0];
        let hideSide = cardElem.getElementsByClassName('hide-side')[0];

        showSide.classList.replace('show-side', 'hide-side');
        hideSide.classList.replace('hide-side', 'show-side');
    }
}

function clickStar(event, id) {
    alert(id);
}

function clickEdit(event, id) {
    alert(id);
}

function clickDelete(event, id) {
    alert(id);
}