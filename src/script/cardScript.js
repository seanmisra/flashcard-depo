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