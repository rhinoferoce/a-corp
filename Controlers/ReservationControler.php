<?php

class ReservationDetailControler {
    /* handle requests that concern reservations */
    var $reservationService;
    var $salleService;
    var $possibleHoursService;
    
    public function __construct() {
        $this->reservationService = new ReservationService();
        $this->salleService = new SalleService();
        $this->possibleHoursService = new PossibleHoursService();
    }

    public function getReservation($id) {
        /* display the single reservation view */

        // get possible hours from possible hours service
        $possibleHoursList = $this->possibleHoursService->getPossibleHours();

        // get list of salles from salle service
        $salleList = $this->salleService->getSalles();

        // get reservation from reservation service
        $reservation = $this->reservationService->getReservationById($id);
        include("Views/ReservationDetailView.php");
    }

    public function getReservationList($day) {
        /* displays a table of reservations, filtered by day */

        // if the day is null, set it to current day, else set it equal to input parameter
        $day = ( $day === null? date("Y-m-d"): $day );

        // get possible hours from possible hours service
        $possibleHoursList = $this->possibleHoursService->getPossibleHours();

        // get list of salles from salle service
        $salleList = $this->salleService->getSalles();

        // get all reservations for each possible start hour. Store it in the reservationListByHour array
        $reservationListByHour = array();
        foreach($possibleHoursList as $hour) {
            $reservationListByHour[$hour['hour']] = $this->reservationService->getReservationsByDayAndHour($day, $hour['id']);
        }

        include("Views/ReservationListByDayView.php");
    }

    public function post() {
        /* create a reservation and redirect */
        $this->reservationService->createReservation($_POST['salleId'], $_POST['day'], $_POST['hourId'], $_POST['numGuests'], $_POST['userId']);
        header("Location: https://a-corp1.000webhostapp.com/reservations/".date("Y-m-d"));
        exit();	
    }

    public function put($id) {
        /* update a reservation and redirect */
        $this->reservationService->updateReservation($id, $_POST['salleId'], $_POST['day'], $_POST['hourId'], $_POST['numGuests'], $_POST['userId']);
        header("Location: https://a-corp1.000webhostapp.com/reservations/".date("Y-m-d"));
        exit();	
    }

    public function delete($id) {
        /* delete a reservation and redirect */
        $this->reservationService->deleteReservation($id);
        header("Location: https://a-corp1.000webhostapp.com/reservations/".date("Y-m-d"));
        exit();	
    }
}
?>
