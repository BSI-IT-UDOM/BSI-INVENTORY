document.getElementById('cancelCre').addEventListener('click', function() {
    document.getElementById('popupcreate').classList.add('hidden');
});
document.getElementById('cancelEdit').addEventListener('click', function() {
    document.getElementById('editPopup').classList.add('hidden');
});
const createButton = document.getElementById('createButton');
const popupForm = document.getElementById('popupcreate');
createButton.addEventListener('click', () => {
  popupForm.classList.remove('hidden');
});