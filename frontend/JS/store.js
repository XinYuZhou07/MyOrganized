let filtersBtn = document.querySelectorAll(".filter-button");

filtersBtn.forEach(element => {
    element.addEventListener("click", function(){
        if(element.classList.contains("filter-active")){
            element.classList.remove("filter-active");
            console.log(element.innerHTML);
        }else{
            element.classList.add("filter-active");
        }
    })
});

