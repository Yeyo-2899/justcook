let navbar = document.querySelector('.navbar');
let searchForm = document.querySelector('.search-form');
let filters =  document.querySelector('.filters-container');
let header = document.querySelector('header');

window.addEventListener('scroll', function(){
    let value = window.scrollY;
    
    header.style.marginTop = value * -0.5 + 'px';
})

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    filters.classList.remove('active');
}

document.querySelector('#search-space').onclick = () =>{
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    filters.classList.remove('active');
}

document.querySelector('#filter-btn').onclick = () =>{
    filters.classList.toggle('active');
    navbar.classList.remove('active');
}

document.querySelector('#search-btn').onclick = () =>{
    filters.classList.remove('active');
}

document.querySelector('.navbar').onclick = () =>{
    navbar.classList.remove('active');
}