(function () {
    var calendar = null;

    function readConfig() {
        return window.recruiterInterviewsConfig || {};
    }

    function showDeleteModal(interviewId, candidateName) {
        var modal = document.getElementById('deleteModal');
        var candidateNameEl = document.getElementById('candidateName');
        var deleteForm = document.getElementById('deleteForm');
        var config = readConfig();

        if (!modal || !candidateNameEl || !deleteForm) {
            return;
        }

        candidateNameEl.textContent = candidateName || '';
        deleteForm.action = (config.destroyBaseUrl || '/recruiter/interviews') + '/' + interviewId;
        modal.classList.remove('hidden');
    }

    function hideDeleteModal() {
        var modal = document.getElementById('deleteModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function bindDeleteModalDismiss() {
        var modal = document.getElementById('deleteModal');
        if (!modal) {
            return;
        }

        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                hideDeleteModal();
            }
        });
    }

    function applyEventStatusStyle(info) {
        var status = info.event.extendedProps.status || 'programme';

        var colors = {
            programme: { bg: '#00b6b4', border: '#00b6b4', text: '#ffffff' },
            confirme: { bg: '#10b981', border: '#10b981', text: '#ffffff' },
            en_attente: { bg: '#f59e0b', border: '#f59e0b', text: '#1a1a1a' },
            annule: { bg: '#ef4444', border: '#ef4444', text: '#ffffff' },
            termine: { bg: '#6b7280', border: '#6b7280', text: '#ffffff' }
        };

        var eventColors = colors[status] || colors.programme;

        info.el.setAttribute('data-status', status);
        info.el.style.removeProperty('--fc-event-bg-color');
        info.el.style.removeProperty('--fc-event-border-color');
        info.el.style.removeProperty('--fc-event-text-color');
        info.el.style.setProperty('background-color', eventColors.bg, 'important');
        info.el.style.setProperty('border-color', eventColors.border, 'important');
        info.el.style.setProperty('color', eventColors.text, 'important');

        var eventMain = info.el.querySelector('.fc-event-main');
        if (eventMain) {
            eventMain.style.setProperty('color', eventColors.text, 'important');
        }

        var eventTitle = info.el.querySelector('.fc-event-title');
        if (eventTitle) {
            eventTitle.style.setProperty('color', eventColors.text, 'important');
        }

        var eventTime = info.el.querySelector('.fc-event-time');
        if (eventTime) {
            eventTime.style.setProperty(
                'color',
                eventColors.text === '#1a1a1a' ? '#1a1a1a' : 'rgba(255, 255, 255, 0.9)',
                'important'
            );
        }

        var eventDot = info.el.querySelector('.fc-event-dot');
        if (eventDot) {
            eventDot.style.setProperty('background-color', eventColors.bg, 'important');
        }

        var event = info.event;
        var startTime = event.start
            ? event.start.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' })
            : '';

        info.el.title = [
            event.title || '',
            startTime,
            event.extendedProps.type || '',
            event.extendedProps.location || ''
        ].join('\n');
    }

    function initCalendar() {
        var config = readConfig();
        var calendarEl = document.getElementById('calendar');

        if (!calendarEl || typeof FullCalendar === 'undefined') {
            return;
        }

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: window.innerWidth < 640 ? 'prev,next' : 'prev,next today',
                center: 'title',
                right: window.innerWidth < 640 ? 'dayGridMonth' : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            locale: 'fr',
            buttonText: {
                today: "Aujourd'hui",
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
            },
            dayHeaderFormat: { weekday: 'long' },
            dayMaxEvents: 3,
            moreLinkClick: 'popover',
            eventDisplay: 'block',
            events: function (info, successCallback, failureCallback) {
                fetch((config.calendarFeedUrl || '') + '?start=' + info.startStr + '&end=' + info.endStr)
                    .then(function (response) { return response.json(); })
                    .then(function (data) {
                        var events = Array.isArray(data) ? data : (Array.isArray(data.data) ? data.data : []);

                        successCallback(events);
                    })
                    .catch(function (error) {
                        failureCallback(error);
                    });
            },
            eventClick: function () {
                window.location.href = config.interviewsUrl || '/recruiter/interviews';
            },
            height: 'auto',
            themeSystem: 'standard',
            dayMaxEventRows: 2,
            eventDidMount: applyEventStatusStyle
        });

        calendar.render();

        window.addEventListener('resize', function () {
            if (calendar) {
                calendar.updateSize();
            }
        });
    }

    function bindViewToggle() {
        var listBtn = document.getElementById('listView');
        var calendarBtn = document.getElementById('calendarViewBtn');
        var interviewsList = document.getElementById('interviewsList');
        var calendarView = document.getElementById('calendarView');

        if (!listBtn || !calendarBtn || !interviewsList || !calendarView) {
            return;
        }

        listBtn.addEventListener('click', function () {
            interviewsList.classList.remove('hidden');
            calendarView.classList.add('hidden');

            listBtn.classList.add('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            listBtn.classList.remove('text-[#9ca3af]');
            calendarBtn.classList.remove('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            calendarBtn.classList.add('text-[#9ca3af]');
        });

        calendarBtn.addEventListener('click', function (event) {
            event.preventDefault();
            interviewsList.classList.add('hidden');
            calendarView.classList.remove('hidden');

            calendarBtn.classList.add('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            calendarBtn.classList.remove('text-[#9ca3af]');
            listBtn.classList.remove('bg-[#2b2b2b]', 'text-[#f5f5f5]', 'shadow-sm');
            listBtn.classList.add('text-[#9ca3af]');

            if (calendar) {
                calendar.refetchEvents();
                window.requestAnimationFrame(function () {
                    calendar.updateSize();
                });
            }
        });
    }

    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
        }
    }

    function closeModal(modalId) {
        var modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function bindCandidateModalHandlers() {
        ['cancelModal', 'changeModal', 'problemModal'].forEach(function (modalId) {
            var modal = document.getElementById(modalId);

            if (!modal) {
                return;
            }

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal(modalId);
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        try {
            bindDeleteModalDismiss();
            bindViewToggle();
            initCalendar();
            bindCandidateModalHandlers();
        } catch (error) {
            // Silent fail for dashboard non-blocking interactions.
        }
    });

    window.showDeleteModal = showDeleteModal;
    window.hideDeleteModal = hideDeleteModal;
    window.openCancelModal = function () { openModal('cancelModal'); };
    window.closeCancelModal = function () { closeModal('cancelModal'); };
    window.openChangeModal = function () { openModal('changeModal'); };
    window.closeChangeModal = function () { closeModal('changeModal'); };
    window.openProblemModal = function () { openModal('problemModal'); };
    window.closeProblemModal = function () { closeModal('problemModal'); };
})();
