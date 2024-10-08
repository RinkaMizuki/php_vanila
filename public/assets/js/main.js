document.addEventListener('DOMContentLoaded', () => {
    const baseUrl = `${window.location.protocol}//${window.location.hostname}:${window.location.port}`;
    const newUserBtn = document.querySelector("#new-user-btn");
    const deleteUserBtn = document.querySelectorAll("#delete-user-btn");
    const loginBtn = document.querySelector("#login-btn");
    const registerBtn = document.querySelector("#register-btn");
    const submitRegisterBtn = document.querySelector("#submit-register-btn");
    const submitLoginBtn = document.querySelector("#submit-login-btn");
    const registerFormElm = document.querySelector("#register-form");
    const profileFormElm = document.querySelector("#profile-form");
    const loginFormElm = document.querySelector("#login-form");
    const submitProfileBtn = document.querySelector("#submit-profile-btn");
    const passwordInputElm = loginFormElm?.querySelector("#password");
    const avatarInputElm = document.querySelector("#avatar");
    const avatarPreviewElm = document.querySelector("#avatar-preview");
    const removeAvatarBtn = document.querySelector("#remove-avatar-btn");

    if (newUserBtn) {
        newUserBtn.onclick = function () {
            window.location.href = '/users/create';
        }
    }

    if (deleteUserBtn) {
        deleteUserBtn.forEach(elm => {
            elm.onclick = async function (e) {
                try {
                    const userId = e.target.getAttribute('user-id');
                    await fetch(`${baseUrl}/users/delete?id=${userId}`, {
                        method: "DELETE",
                    })
                    window.location.href = '/users';
                } catch (error) {
                    alert(error?.message || "Error while process server side");
                }
            }
        })
    }

    if (loginBtn) {
        loginBtn.onclick = function () {
            window.location.href = '/login';
        }
    }

    if (registerBtn) {
        registerBtn.onclick = function () {
            window.location.href = '/register';
        }
    }

    if (submitRegisterBtn) {
        submitRegisterBtn.onclick = function () {
            registerFormElm.submit();
        }
    }

    if (submitLoginBtn) {
        submitLoginBtn.onclick = function () {
            loginFormElm.submit();
        }
        if (passwordInputElm) {
            passwordInputElm.onkeydown = async function (e) {
                if (e.key === 'Enter') {
                    loginFormElm.submit();
                }
            }
        }
    }

    if (avatarInputElm) {
        avatarInputElm.onchange = function (e) {
            const file = e.target.files[0];
            if (file) {
                const maxSize = 25 * 1024 * 1024; // 25MB limit
                if (file.size > maxSize) {
                    alert("File size exceeds the 25MB limit.");
                    e.target.value = '';
                }
            }
        };
    }

    if (submitProfileBtn) {
        submitProfileBtn.onclick = function () {
            if (profileFormElm) {
                profileFormElm.submit();
            }
        }
    }

    if (avatarPreviewElm && avatarPreviewElm.src && avatarPreviewElm.src.includes(baseUrl)) {
        (async () => {
            try {
                const url = avatarPreviewElm.src;
                const blobFile = await (await fetch(url)).blob();
                const fileList = new DataTransfer(); // Create a new DataTransfer object
                let fileName = url.substring(url.lastIndexOf('/') + 1); // Extract the filename
                fileName = decodeURIComponent(fileName.replace(/^\d+_/, ''));

                const currFile = new File([blobFile], fileName, { type: blobFile.type }); // Create a new File object

                fileList.items.add(currFile); // Add the file to the DataTransfer object

                avatarInputElm.files = fileList.files; // Set the files property to the FileList
            } catch (error) {
                console.error('Error setting file:', error);
            }
        })();
    }

    if (removeAvatarBtn) {
        removeAvatarBtn.onclick = function () {
            avatarInputElm.value = '';
        }
    }
});