function insertLabel() {
    document.querySelector('.for__img').innerHTML= document.querySelector('#img').files[0].name;
}
document.querySelector('#img').addEventListener('change', insertLabel);