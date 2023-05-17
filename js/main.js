var modal = document.getElementById("myModal");
var closeBtn = document.getElementsByClassName("close")[0];

// Открытие кнопки "more info" и вывод информации внутри модального окна
var btns = document.getElementsByClassName("btn-primary");
for (var i = 0; i < btns.length; i++) {
    btns[i].onclick = function() {
      var photoItem = this.parentElement;
      var img = photoItem.getElementsByTagName("img")[0];
      var title = photoItem.getElementsByClassName("photo-title")[0].textContent;
      var description = photoItem.getElementsByTagName("p")[1].textContent;
      var date = photoItem.getElementsByTagName("p")[2].textContent;
  
      document.getElementById("modal-img").src = img.src;
      document.getElementById("modal-title").textContent = title;
      document.getElementById("modal-description").textContent = description;
      document.getElementById("modal-date").textContent = date;
  
      modal.style.display = "block";
    }
  }

// Закрытие модального окна по крестику
closeBtn.onclick = function(){
    modal.style.display="none";
}

// Закрытие не по крестику 
window.onclick = function(event){
    if (event.target == modal){
        modal.style.display="none";
    }
}