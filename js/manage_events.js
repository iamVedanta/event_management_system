document.addEventListener("DOMContentLoaded", function () {
  const eventCardsContainer = document.getElementById("eventCards");
  const eventDetailsContainer = document.getElementById("eventDetails");
  const eventDetailsContent = document.getElementById("eventDetailsContent");
  const eventFilterInput = document.getElementById("eventFilter");

  function fetchEvents() {
    fetch("php/get_events.php")
      .then((response) => response.json())
      .then((events) => {
        displayEventCards(events);
        setupFilter(events);
      })
      .catch((error) => console.error("Error fetching events:", error));
  }

  function displayEventCards(events) {
    eventCardsContainer.innerHTML = "";
    events.forEach((event) => {
      const card = document.createElement("div");
      card.className = "card";
      card.innerHTML = `
                <h4>${event.EventName}</h4>
                <p>Date: ${event.EventDate}</p>
                <p>Location: ${event.Location}</p>
            `;
      card.addEventListener("click", () => showEventDetails(event.EventID));
      eventCardsContainer.appendChild(card);
    });
  }

  function showEventDetails(eventID) {
    fetch(`php/get_event_details.php?eventID=${eventID}`)
      .then((response) => response.json())
      .then((details) => {
        if (
          details.organizers ||
          details.sponsors ||
          details.participants ||
          details.venue
        ) {
          displayEventDetails(details);
        } else {
          alert("No details found for this event.");
        }
      })
      .catch((error) => console.error("Error fetching event details:", error));
  }

  function displayEventDetails(details) {
    eventDetailsContent.innerHTML = `
            <h4>Organizers</h4>
            <ul>${details.organizers
              .map((org) => `<li>${org.OrganizerName}</li>`)
              .join("")}</ul>
            <h4>Sponsors</h4>
            <ul>${details.sponsors
              .map((sp) => `<li>${sp.SponsorName}</li>`)
              .join("")}</ul>
            <h4>Participants</h4>
            <ul>${details.participants
              .map((p) => `<li>${p.ParticipantName}</li>`)
              .join("")}</ul>
            <h4>Venue</h4>
            <p>${details.venue.VenueName} - ${details.venue.Address}</p>
        `;
    eventDetailsContainer.style.display = "block";
  }

  function setupFilter(events) {
    eventFilterInput.addEventListener("input", () => {
      const filterText = eventFilterInput.value.toLowerCase();
      const filteredEvents = events.filter(
        (event) =>
          event.EventName.toLowerCase().includes(filterText) ||
          event.Location.toLowerCase().includes(filterText)
      );
      displayEventCards(filteredEvents);
    });
  }

  fetchEvents();
});
