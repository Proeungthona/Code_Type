const getFormJSON = (form) => {
    const data = new FormData(form);
    return Array.from(data.keys()).reduce((result, key) => {
      result[key] = data.get(key);
      return result;
    }, {});
  };

function handleSubmit(event) {
    event.preventDefault();
  
    const data = getFormJSON(event.target);
  
    (async () => {
        const rawResponse = await fetch('/index.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        });
        const content = await rawResponse.text();

        if (content.includes("Success")){
            window.location.replace("/profile.php");
        } else {
            document.getElementById("msgbox").style = "";
        }
      })();
  }
  
  const form = document.querySelector('#loginform');
  form.addEventListener('submit', handleSubmit);