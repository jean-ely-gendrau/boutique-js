function filterPrice() {
    const select = document.getElementById('prix').value;
    fetch(`/js-test/${select}`, {
      headers: {
        "Content-Type": "application/json",
      }
    })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        console.log(data);
      })
      .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
      });
    ;
  }