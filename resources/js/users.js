'use strict'

window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');



/**
 * Funcion para asociar las asignaturas a los docentes y los estudiantes
 * @param {int} rol 
 * @param {int} id 
 */
window.setSubjectUser = function (rol, id) {
    console.log(rol);
    console.log(id);

    let roles = {
        '1': 'Admin',
        '2': 'Docente',
        '3': 'Estudiante'
    }

    let rolName = roles[rol];

    const  elementTitle = document.getElementById('assign_subjectLabel');
    const  elementIdUser = document.getElementById('id_user');
    const  elementRolUser = document.getElementById('rol_user');
    elementTitle.innerHTML = rolName + ' - Asignar Materia';
    elementIdUser.setAttribute('value', id);
    elementRolUser.setAttribute('value', rol);

    axios.post('/api/subjects-list')
                .then((response)=>{
                    const  elementSubject = document.getElementById('subject');
                    let options = '<option selected>Seleccione...</option>';

                    let data = response.data.data[0];
                    data.forEach( function (valor, indice, array) {
                        options += '<option value="' + valor.id + '">' + valor.name + '</option>'
                    });
                    elementSubject.innerHTML = options;
                })

    let myModal = new bootstrap.Modal(document.getElementById('assign_subject'), {})
    myModal.show()
}

window.saveSubject = function () {
    const  elementSubject = document.getElementById('subject');
    const  elementIdUser = document.getElementById('id_user');
    const  elementRolUser = document.getElementById('rol_user');

    let subject = elementSubject.options[elementSubject.selectedIndex].value;
    let id = elementIdUser.value;
    let rol = elementRolUser.value;

    let data = {
        subject: subject,
        id: id,
        rol: rol
    }

    axios.post('/api/save-subject-user', data)
                .then((response)=>{
                    console.log(response);
                })


}
