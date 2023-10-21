document.addEventListener("DOMContentLoaded", function(event){
    const forms = document.querySelectorAll('.delete__form--prompt');
    forms.forEach(form => {
        form.addEventListener('submit', (event)=>{
            event.preventDefault();
            if(confirm('Are you sure you want to delete comment?')){
                console.log(event)
                event.currentTarget.submit();
            }

        })
    });
  });
