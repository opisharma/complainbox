window.addEventListener('load',function () {
    var role = document.querySelector('#role_id');
    role.addEventListener('change',function (e) {
        var student_id_input = document.querySelector('.student_id_input');
        var author_id_input = document.querySelector('.author_id_input');
        
        e.target.value === '3' ? student_id_input.style.display = 'block' : student_id_input.style.display = 'none';
        e.target.value === '2' ? author_id_input.style.display = 'block' : author_id_input.style.display = 'none';
        
    })
});