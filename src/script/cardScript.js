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

function getFormById(id) {
    let cardForm = document.getElementById("card-icons-" + id);
    return cardForm;
} 

function submitFavorite(id) {
    let favoriteInput = document.getElementById("favorite-input-" + id);
    favoriteInput.value = id;

    let cardForm = getFormById(id);
    cardForm.submit();
}


function submitEdit(id) {
    let editInput = document.getElementById("edit-input-" + id);
    editInput.value = id;

    let cardForm = getFormById(id);
    cardForm.submit();
}

function submitDelete(id) {
    let deleteInput = document.getElementById("delete-input-" + id);
    deleteInput.value = id;

    let cardForm = getFormById(id);
    cardForm.submit();
}

function toggleCreateCard () {
    console.log('toggleCreateCard');
    let createForm = document.getElementById("create-card-form");
    let hide = createForm.className.split(' ').includes('invisible');

    let hideCreateCard = document.getElementById('hide-create-card');
    let showCreateCard = document.getElementById('show-create-card');

    if (hide) {
        createForm.classList.replace('invisible', 'visible');
        hideCreateCard.classList.replace('invisible', 'visible-inline');
        showCreateCard.classList.replace('visible-inline', 'invisible');

    } else {
        createForm.classList.replace('visible', 'invisible');
        hideCreateCard.classList.replace('visible-inline', 'invisible');
        showCreateCard.classList.replace('invisible', 'visible-inline');
    }
}

function submitCardForm() {
    
    let cardSearchForm = document.getElementById("card-search-form");
    cardSearchForm.submit();
}