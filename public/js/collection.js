const addSujetFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');                // mettre une class="btn btn-danger"
    removeFormButton.innerText = 'Supprimer le sujet';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
}                                                                             // A COLLER pour supprimer

const addFormToCollection = (e) => {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

    const item = document.createElement('li');

    item.innerHTML = collectionHolder
      .dataset
      .prototype
      .replace(
        /__name__/g,
        collectionHolder.dataset.index
      );
    
    addSujetFormDeleteLink(item);                  // A COLLER pour la suppression (une phrase)
    collectionHolder.appendChild(item);
  
    collectionHolder.dataset.index++;
  };                                                                        // A COLLER AVANT le 2eme block

document
  .querySelectorAll('.add_item_link')
  .forEach(btn => {
      btn.addEventListener("click", addFormToCollection)
  });                                                                       // A COLLER pour l'ajout



document
  .querySelectorAll('ul.images li')
  .forEach((sujet) => {
      addSujetFormDeleteLink(sujet)
  })                                                                        // A COLLER pour la suppression

