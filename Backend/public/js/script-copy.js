const halaman = document.body.id;

window.onload = function () {
    let username = localStorage.getItem("username");
    if (username) {
        let usernameElements = document.getElementsByClassName("username");
        for (let i = 0; i < usernameElements.length; i++) {
            usernameElements[i].textContent = username;
        }
    }

    let savedImage = localStorage.getItem("profileImage");
    if (savedImage) {
        let profileImages = document.querySelectorAll(".profile-image");
        profileImages.forEach(img => {
            img.src = savedImage;
        });
    }

    if (halaman === "halaman-jadwal") {
        renderCalendar();
    }
};

if (halaman === "halaman-home") {
    function updateJam() {
        const now = new Date();
        const hour = now.getHours().toString().padStart(2, '0');
        const minute = now.getMinutes().toString().padStart(2, '0');
        const second = now.getSeconds().toString().padStart(2, '0');
        const timeString = `${hour}:${minute}:${second}`;
        document.getElementById("jam").textContent = timeString;
    }

    function updateTanggal() {
        const now = new Date();
        const hariAngka = now.getDay();
        const arrayHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
        const hari = arrayHari[hariAngka];
        const tanggal = now.getDate().toString();
        const bulanAngka = now.getMonth();
        const arrayBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const bulan = arrayBulan[bulanAngka];
        const tahun = now.getFullYear().toString();
        const dateString = `${hari}, ${tanggal} ${bulan} ${tahun}`;
        document.getElementById("tanggal").textContent = dateString;
    }

    updateJam();
    setInterval(updateJam, 1000);

    updateTanggal();
    setInterval(updateTanggal, 1000);
}

else if (halaman === "halaman-akun") {
    document.addEventListener('DOMContentLoaded', () => {
        const saveNameBtn = document.getElementById('saveNameBtn');
        if (saveNameBtn) {
            saveNameBtn.addEventListener('click', saveName);
        }

        const savePhotoBtn = document.getElementById('savePhotoBtn');
        if (savePhotoBtn) {
            savePhotoBtn.addEventListener('click', savePhoto);
        }
    });

    function saveName() {
        let usernameBaru = document.getElementById("input-username").value;
        if (usernameBaru) {
            localStorage.setItem("username", usernameBaru);
            let usernameElements = document.getElementsByClassName("username");

            for (let i = 0; i < usernameElements.length; i++) {
                usernameElements[i].textContent = usernameBaru;
            }
            alert("Username berhasil diubah");
            document.getElementById("input-username").value = "";
        } else {
            alert("Masukkan username");
        }
    }

    function savePhoto() {
        let fileInput = document.getElementById("input-file");
        let profileImages = document.querySelectorAll(".profile-image");

        if (fileInput.files && fileInput.files[0]) {
            let reader = new FileReader();

            reader.onload = function (e) {
                let imageData = e.target.result;

                profileImages.forEach(img => {
                    img.src = imageData;
                });

                localStorage.setItem("profileImage", imageData);
                alert("Foto profil berhasil diubah");
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            alert("Pilih file gambar.");
        }
    }
}

else if (halaman === "halaman-jadwal") {
    const monthYearSpan = document.getElementById('monthYear');
    const daysContainer = document.getElementById('days');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');

    let currentDate = new Date();

    const bookingsByDay = window.bookingsByDay || {}; // Expect this to be injected from backend

    function renderCalendar() {
        daysContainer.innerHTML = '';
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();
        const today = new Date();

        monthYearSpan.textContent = currentDate.toLocaleString('id-ID', { month: 'long', year: 'numeric' });

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.classList.add('day', 'empty');
            daysContainer.appendChild(emptyCell);
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayCell = document.createElement('div');
            dayCell.classList.add('day');

            if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                dayCell.classList.add('today');
            }

            if (bookingsByDay[day]) {
                dayCell.classList.add('hasMeeting');
            }

            const dateNumber = document.createElement('div');
            dateNumber.classList.add('date-number');
            dateNumber.innerText = day;
            dayCell.appendChild(dateNumber);

            if (bookingsByDay[day]) {
                const bookingList = document.createElement('ul');
                bookingList.classList.add('booking-list');

                bookingsByDay[day].forEach(booking => {
                    const bookingItem = document.createElement('li');
                    bookingItem.classList.add('booking-item');
                    bookingItem.innerText = booking.nama_pemesan || 'Booking Terjadwal';
                    bookingItem.title = booking.nama_pemesan || 'Booking Terjadwal';
                    bookingList.appendChild(bookingItem);
                });

                dayCell.appendChild(bookingList);
            }

            daysContainer.appendChild(dayCell);
        }
    }

    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });
}


    // Close popup when clicking outside or on the close button
    const meetingPopupContainer = document.getElementById('meetingPopupContainer');
    if (meetingPopupContainer) { // Check if the element exists
        meetingPopupContainer.addEventListener('click', (event) => {
            // Close if clicked on the container itself or the close button
            if (event.target === event.currentTarget || event.target.classList.contains('close-button')) {
                closeMeetingPopup();
            }
        });
    } 