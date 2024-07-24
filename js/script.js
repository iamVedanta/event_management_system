document.addEventListener("DOMContentLoaded", function () {
  const formConfigs = [
    { id: "organizerForm", url: "php/add_organizer.php" },
    { id: "eventForm", url: "php/add_event.php" },
    { id: "participantForm", url: "php/add_participant.php" },
    { id: "sponsorForm", url: "php/add_sponsor.php" },
    { id: "venueForm", url: "php/add_venue.php" },
  ];

  formConfigs.forEach((config) => {
    const form = document.getElementById(config.id);
    if (form) {
      form.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch(config.url, {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((result) => {
            alert(result);
            this.reset();
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    } else {
      console.error(`Form with ID "${config.id}" not found.`);
    }
  });
});
