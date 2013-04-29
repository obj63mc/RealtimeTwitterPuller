<?php
require_once('lib/Phirehose.php');
require_once 'inc/config.inc.php';

/**
 * Example of using Phirehose to display a live filtered stream using track words 
 */
class FilterTrackConsumer extends Phirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process. 
     */
    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['screen_name'])) {
      print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
    }
    $ch = curl_init($yourappdomain);    
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('updates'=> $status)));
    $return = curl_exec($ch);
  }
}

// Start streaming
$sc = new FilterTrackConsumer($twitter_username, $twitter_pw, Phirehose::METHOD_FILTER);
$sc->setTrack(array($tag));
$sc->consume();