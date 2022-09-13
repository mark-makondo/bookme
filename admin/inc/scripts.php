<!-- Bootstrap: JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous" defer></script>
<!-- SwiperJs -->
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js" defer></script>

<!-- My Scripts -->
<script>
    function customAlert(type = "success", message = "",className ="", position="body") {
        let bsClass = (type == 'success') ? "alert-success" : 'alert-warning';  
        let element = document.createElement('div');

        element.innerHTML = `
            <div class="alert ${bsClass} alert-dismissible fade show ${className}" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div
        `
        if(position == 'body')
            document.body.append(element);
        else document.getElementById(position).appendChild(element);

        setTimeout(removeAlert, 2000);
    }
    function removeAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }
</script>
<script src="js/global-script.js" defer></script>