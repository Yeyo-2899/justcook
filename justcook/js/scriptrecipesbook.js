let searchForm = document.querySelector('.search-form');
let filters =  document.querySelector('.filters-container');
let header = document.querySelector('header');

window.addEventListener('scroll', function(){
    let value = window.scrollY;
    
    header.style.marginTop = value * -0.5 + 'px';
})

document.querySelector('#filter-btn').onclick = () =>{
    filters.classList.toggle('active');
    navbar.classList.remove('active');
}

document.querySelector('#search-btn').onclick = () =>{
    filters.classList.remove('active');
}

document.querySelector('#home-btn').onclick = () =>{
    window.location.href = '../index.php';
}