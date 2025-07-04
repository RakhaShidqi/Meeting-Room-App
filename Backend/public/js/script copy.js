const halaman = document.body.id;

window.onload = function() {
    let username = localStorage.getItem("username");
    if (username) {
        // Ambil semua elemen dengan kelas "username"
        let usernameElements = document.getElementsByClassName("username");
        
        // Loop untuk mengisi semua elemen dengan kelas "username"
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

    // Initialize calendar if on "halaman-jadwal"
    if (halaman === "halaman-jadwal") {
        renderCalendar(); // Call renderCalendar here on load
    }
}

if (halaman === "halaman-home") {
    function updateJam() {
        const now = new Date();
        const hour = now.getHours().toString().padStart(2, 0);
        const minute = now.getMinutes().toString().padStart(2, 0);
        const second = now.getSeconds().toString().padStart(2, 0);
        const timeString = `${hour}:${minute}:${second}`;
        document.getElementById("jam").textContent = timeString;
    }
    
    function updateTanggal() {
        const now = new Date();
        
        const hariAngka = now.getDay();
        const arrayHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu']; // Corrected Sunday to index 0
        const hari = arrayHari[hariAngka];
        
        const tanggal = now.getDate().toString();
    
        const bulanAngka = (now.getMonth());
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
    // Ensure these functions are globally accessible or attached to relevant elements
    // For simplicity, defining them here as they are only used on this page
    document.addEventListener('DOMContentLoaded', () => { // Ensure DOM is loaded for elements
        const saveNameBtn = document.getElementById('saveNameBtn'); // Assuming you have a button with this ID
        if (saveNameBtn) {
            saveNameBtn.addEventListener('click', saveName);
        }

        const savePhotoBtn = document.getElementById('savePhotoBtn'); // Assuming you have a button with this ID
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
                alert("Foto profil berhasil diubah"); // Add an alert for photo change
            };
            reader.readAsDataURL(fileInput.files[0]);
        } else {
            alert("Pilih file gambar."); // Inform user if no file is selected
        }
    }
}

else if (halaman === "halaman-jadwal") {
    const monthYearSpan = document.getElementById('monthYear');
    const daysContainer = document.getElementById('days');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');

    let currentDate = new Date();

    // Dummy data for meetings. In a real application, this would come from a database.
    const meetings = {
        // Format: 'YYYY-MM-DD': [{ time: 'HH:MM AM/PM', title: 'Meeting Title', canceled: boolean }]
        '2025-07-02': [
            { time: '09:30 AM', title: 'Canceled: Manatal Live Demo (II)...', canceled: true },
            { time: '11:30 AM', title: 'Manatal Introduction | Hypermet...', canceled: false },
            { time: '02:10 PM', title: 'Canceled event: Mana...', canceled: true }
        ],
        '2025-07-10': [
            { time: '10:00 AM', title: 'Demo Manat', canceled: false },
            { time: '04:00 PM', title: 'Interview Solu', canceled: false }
        ],
        '2025-07-23': [
            { time: '03:00 PM', title: 'Pembahasan Fi', canceled: false }
        ],
        '2025-07-30': [
            { time: '10:00 AM', title: 'Pembahasan', canceled: false }
        ],
        '2025-10-02': [ // Example for October 2024 from your image (adjusted to 2025 for consistency)
            { time: '09:30 AM', title: 'Canceled: Manatal Live Demo (II)...', canceled: true },
            { time: '11:30 AM', title: 'Manatal Introduction | Hypermet...', canceled: false },
            { time: '02:10 PM', title: 'Canceled event: Mana...', canceled: true }
        ]
    };

    function renderCalendar() {
        daysContainer.innerHTML = ''; // Clear previous days
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        monthYearSpan.textContent = currentDate.toLocaleString('id-ID', { month: 'long', year: 'numeric' });

        const firstDayOfMonth = new Date(year, month, 1).getDay(); // 0 for Sunday, 1 for Monday, etc.
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        // Add empty cells for the days before the 1st of the month
        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.classList.add('empty-day');
            daysContainer.appendChild(emptyDiv);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.textContent = day;
            // Format date to YYYY-MM-DD for consistency with meetings object keys
            const formattedDate = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
            dayDiv.dataset.date = formattedDate; // Store the full date in a data attribute

            if (meetings[formattedDate] && meetings[formattedDate].length > 0) {
                dayDiv.classList.add('has-meeting');
            }

            dayDiv.addEventListener('click', () => showMeetingPopup(formattedDate));
            daysContainer.appendChild(dayDiv);
        }
    }

    function showMeetingPopup(date) {
        const popupContainer = document.getElementById('meetingPopupContainer');
        const popupContent = document.getElementById('meetingPopupContent');
        const popupDateHeader = document.getElementById('popupDateHeader');

        const dateParts = date.split('-');
        // Note: Month in Date constructor is 0-indexed, so subtract 1
        const displayDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);
        popupDateHeader.textContent = displayDate.toLocaleString('id-ID', { weekday: 'short', day: 'numeric', month: 'short' });

        popupContent.innerHTML = ''; // Clear previous content

        const dayMeetings = meetings[date];
        if (dayMeetings && dayMeetings.length > 0) {
            dayMeetings.forEach(meeting => {
                const meetingDiv = document.createElement('div');
                meetingDiv.classList.add('meeting-item');

                const timeSpan = document.createElement('span');
                timeSpan.classList.add('meeting-time');
                timeSpan.textContent = meeting.time;
                meetingDiv.appendChild(timeSpan);

                const titleSpan = document.createElement('span');
                titleSpan.classList.add('meeting-title');
                if (meeting.canceled) {
                    titleSpan.classList.add('canceled');
                    titleSpan.textContent = 'Canceled: ' + meeting.title.replace('Canceled: ', ''); // Remove duplicate 'Canceled:' if any
                } else {
                    titleSpan.textContent = meeting.title;
                }
                meetingDiv.appendChild(titleSpan);

                // // Hapus bagian ini untuk menghilangkan ikon paperclip
                // if (meeting.canceled) {
                //     const paperclip = document.createElement('img');
                //     paperclip.src = '../img/paperclip.png';
                //     paperclip.alt = 'Attachment';
                //     paperclip.classList.add('paperclip-icon');
                //     meetingDiv.appendChild(paperclip);
                // }
                
                popupContent.appendChild(meetingDiv);
            });
        } else {
            popupContent.innerHTML = '<p>Tidak ada jadwal meeting untuk tanggal ini.</p>';
        }

        popupContainer.style.display = 'flex'; // Show the popup
    }

    function closeMeetingPopup() {
        document.getElementById('meetingPopupContainer').style.display = 'none';
    }

    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    });

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
}