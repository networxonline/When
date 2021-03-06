<?php

use When\When;

class WhenOccurrencesBetweenTest extends PHPUnit_Framework_TestCase
{

    /* Get slices of an unbounded weekly recurrence */
    function testGetWeeklyOccurrencesBetweenEarlySlice() {
        $results = array();
        $results[] = new DateTime('1997-09-02 09:00:00');
        $results[] = new DateTime('1997-09-09 09:00:00');
        $results[] = new DateTime('1997-09-16 09:00:00');
        $results[] = new DateTime('1997-09-23 09:00:00');
        $results[] = new DateTime('1997-09-30 09:00:00');
        $results[] = new DateTime('1997-10-07 09:00:00');
        $results[] = new DateTime('1997-10-14 09:00:00');
        $results[] = new DateTime('1997-10-21 09:00:00');
        $results[] = new DateTime('1997-10-28 09:00:00');
        $results[] = new DateTime('1997-11-04 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY");
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-09-02 09:00:00'),
        new DateTime('1997-11-04 09:01:00'));

        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }

    /* Get slices of an unbounded weekly recurrence */
    function testGetWeeklyOccurrencesBetweenLaterSlice() {

        $results = array();
        $results[] = new DateTime('2016-01-26 09:00:00');
        $results[] = new DateTime('2016-02-02 09:00:00');
        $results[] = new DateTime('2016-02-09 09:00:00');
        $results[] = new DateTime('2016-02-16 09:00:00');
        $results[] = new DateTime('2016-02-23 09:00:00');
        $results[] = new DateTime('2016-03-01 09:00:00');
        $results[] = new DateTime('2016-03-08 09:00:00');
        $results[] = new DateTime('2016-03-15 09:00:00');
        $results[] = new DateTime('2016-03-22 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY");
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('2016-01-25 09:00:00'),
        new DateTime('2016-03-22 09:01:00'));

        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }


    /* Get a slice of an unbounded recurrence, with a limit */
    function testGetWeeklyOccurrencesBetweenEarlySliceWithLimit() {
        $results = array();
        $results[] = new DateTime('1997-09-02 09:00:00');
        $results[] = new DateTime('1997-09-09 09:00:00');
        $results[] = new DateTime('1997-09-16 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY");
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-09-02 09:00:00'),
        new DateTime('1997-11-04 09:01:00'), 3); 

        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }


    function testGetWeeklyOccurrenceWindowBeforeStartDate() {
        $results = array();
        $results[] = new DateTime('1997-09-02 09:00:00');
        $results[] = new DateTime('1997-09-09 09:00:00');
        $results[] = new DateTime('1997-09-16 09:00:00');
        $results[] = new DateTime('1997-09-23 09:00:00');
        $results[] = new DateTime('1997-09-30 09:00:00');
        $results[] = new DateTime('1997-10-07 09:00:00');
        $results[] = new DateTime('1997-10-14 09:00:00');
        $results[] = new DateTime('1997-10-21 09:00:00');
        $results[] = new DateTime('1997-10-28 09:00:00');
        $results[] = new DateTime('1997-11-04 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY");
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1987-09-02 09:00:00'),
        new DateTime('1997-11-04 09:01:00'));

        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }


    /* Test use of until date on bounded occurrence */
    function testGetWeeklyOccurrenceWindowAfterUntilDate() {
        $results = array();
        $results[] = new DateTime('1997-09-02 09:00:00');
        $results[] = new DateTime('1997-09-09 09:00:00');
        $results[] = new DateTime('1997-09-16 09:00:00');
        $results[] = new DateTime('1997-09-23 09:00:00');
        $results[] = new DateTime('1997-09-30 09:00:00');
        $results[] = new DateTime('1997-10-07 09:00:00');
        $results[] = new DateTime('1997-10-14 09:00:00');
        $results[] = new DateTime('1997-10-21 09:00:00');
        $results[] = new DateTime('1997-10-28 09:00:00');
        $results[] = new DateTime('1997-11-04 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY")
          ->until(new DateTime("19971105T090000"));;
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-09-02 09:00:00'),
        new DateTime('2007-11-04 09:01:00'));

        $this->assertEquals(count($results), count($occurrences));
        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }

    /* Test use of count on bounded occurrence */
    function testGetWeeklyOccurrenceWindowBoundedByCount() {
        $results = array();
        $results[] = new DateTime('1997-09-02 09:00:00');
        $results[] = new DateTime('1997-09-09 09:00:00');
        $results[] = new DateTime('1997-09-16 09:00:00');
        $results[] = new DateTime('1997-09-23 09:00:00');
        $results[] = new DateTime('1997-09-30 09:00:00');
        $results[] = new DateTime('1997-10-07 09:00:00');
        $results[] = new DateTime('1997-10-14 09:00:00');
        $results[] = new DateTime('1997-10-21 09:00:00');
        $results[] = new DateTime('1997-10-28 09:00:00');
        $results[] = new DateTime('1997-11-04 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY")
          ->count(10);
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-09-02 09:00:00'),
        new DateTime('2007-11-04 09:01:00'));

        $this->assertEquals(count($results), count($occurrences));
        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }

    /* Test use of count on bounded occurrence with window starting after recurrence start*/
    function testGetWeeklyOccurrenceWindowCountAndStartDate() {
        $results = array();
        $results[] = new DateTime('1997-09-23 09:00:00');
        $results[] = new DateTime('1997-09-30 09:00:00');
        $results[] = new DateTime('1997-10-07 09:00:00');
        $results[] = new DateTime('1997-10-14 09:00:00');
        $results[] = new DateTime('1997-10-21 09:00:00');
        $results[] = new DateTime('1997-10-28 09:00:00');
        $results[] = new DateTime('1997-11-04 09:00:00');

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY")
          ->count(10);
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-09-23 09:00:00'),
        new DateTime('2007-11-04 09:01:00'));

        $this->assertEquals(count($results), count($occurrences));
        foreach ($results as $key => $result) {
             $this->assertEquals($result, $occurrences[$key]); 
        }
    }

    /* Test use of count on bounded occurrence, where no events match window */
    function testGetWeeklyOccurrenceWindowCountAndStartDateNoResults() {

        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY")
          ->count(10);
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-11-05 09:00:00'),
        new DateTime('2007-11-04 09:01:00'));

        $this->assertEquals(0, count($occurrences));
    }

    /* Empty results on backwards date range */
    function testGetWeeklyOccurrencesBackwardsDateRange() {
        $r = new When(); 
        $r->startDate(new DateTime("19970902T090000")) 
          ->rrule("FREQ=WEEKLY");
        
        $occurrences = $r->getOccurrencesBetween(new DateTime('1997-11-04 09:01:00'),
        new DateTime('1997-09-02 09:00:00')); 

        $this->assertEquals(0, count($occurrences));
    }

}
