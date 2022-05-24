"use strict";

window.bootstrap = require("bootstrap/dist/js/bootstrap.bundle.js");

/**
 * Funcion para asociar las asignaturas a los docentes y los estudiantes
 * @param {int} rol
 * @param {int} id
 */
window.setSubjectUser = function (rol, id) {

    let roles = {
        1: "Admin",
        2: "Docente",
        3: "Estudiante",
    };

    let rolName = roles[rol];

    const elementTitle = document.getElementById("assign_subjectLabel");
    const elementIdUser = document.getElementById("id_user");
    const elementRolUser = document.getElementById("rol_user");
    elementTitle.innerHTML = rolName + " - Asignar Materia";
    elementIdUser.setAttribute("value", id);
    elementRolUser.setAttribute("value", rol);

    axios.post("/api/subjects-list").then((response) => {
        const elementSubject = document.getElementById("subject");
        let options = "<option selected>Seleccione...</option>";

        let data = response.data.data[0];
        data.forEach(function (valor, indice, array) {
            options +=
                '<option value="' + valor.id + '">' + valor.name + "</option>";
        });
        elementSubject.innerHTML = options;
    });

    let myModal = new bootstrap.Modal(
        document.getElementById("assign_subject"),
        {}
    );
    myModal.show();
};

/**
 * Funcion para guardar la asociacion del usuario seleccionado
 */
window.saveSubject = function () {
    const elementSubject = document.getElementById("subject");
    const elementIdUser = document.getElementById("id_user");
    const elementRolUser = document.getElementById("rol_user");

    let subject = elementSubject.options[elementSubject.selectedIndex].value;
    let id = elementIdUser.value;
    let rol = elementRolUser.value;

    let data = {
        subject: subject,
        id: id,
        rol: rol,
    };

    axios.post("/api/save-subject-user", data).then((response) => {
        let data = response.data;
        if (data.id > 0) {
            Swal.fire({
                icon: "success",
                title: "Materia Asignada con Exito",
            });
        } else {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Ocurrio un error al asignar la materia, por favor actualice e intente nuevamente.",
            });
        }
    });
};

/**
 * Funcion para asignar una nota al usuario
 * @param {int} student Id del usuario al que deseamos asignar una nota
 */
window.setQualifications = function (student, teacher) {
    Swal.showLoading();

    let data = {
        student: student,
        teacher: teacher,
    };

    axios.post("/api/get-info-student", data).then((response) => {
        if (response.data.error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: response.data.error,
            });
        } else {
            Swal.close();

            let dataStudent = response.data.student.data[0][0];
            let dataTeacher = response.data.teacher.data[0][0];

            let nameStudent = dataStudent.name;

            const elementTitle = document.getElementById(
                "assign_qualificationsLabel"
            );
            const elementIdUser = document.getElementById(
                "user_qualifications"
            );
            const elementQualifications =
                document.getElementById("qualifications");

            elementTitle.innerHTML = nameStudent + " - Asignar Notas";
            elementIdUser.setAttribute("value", student);

            let form = "";
            for (let i = 0; i < 4; i++) {
                form += `
                                <div class="form-floating p-2 m-1">
                                    <input class="form-control qualification" type="number" name="qualification[${i}]" id="qualification[${i}]" value="${
                    dataStudent.qualifications
                }" max='5'>
                                    <label for="qualification[${i}]">Ingrese la nota ${
                    i + 1
                } :</label>
                                </div>
                            `;
            }
            elementQualifications.innerHTML = form;

            let myModal = new bootstrap.Modal(
                document.getElementById("assign_qualifications"),
                {}
            );
            myModal.show();
        }
    });
};

/**
 * Funcion para guardar las notas del estudiante
 */
window.saveQualifications = function () {
    Swal.showLoading();

    //Elementos para obtener los valores de las notas
    const elementIdStudent = document.getElementById("user_qualifications");
    const elementIdTeacher = document.getElementById("teacher_qualifications");
    const elementQualifications = document.getElementsByClassName("qualification");

    //Variables donde guardamos los valores
    let student = elementIdStudent.value;
    let teacher = elementIdTeacher.value;
    let qualifications = [];

    for (let i = 0; i < elementQualifications.length; i++) {
        const element = elementQualifications[i];
        let val = parseFloat(element.value);

        if (val <= 5) {
            qualifications.push(val);            
        }else{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: 'Por favor, digita numeros igual o menores a 5.'
            });
            return;
        }
    }

    let data = {
        student: student,
        teacher: teacher,
        qualifications: qualifications
    }

    axios.post("/api/save-qualifications", data).then((response) => {
        console.log(response);
    });

    Swal.close();

}
