<?php
/**
 * -----------------------------IMPORTANT-------------------------------
 * Programmer should NOT change or add any code without having a better
 * understanding how MY_CONTROLLER and Its methods been used
 * ---------------------------------------------------------------------
 *
 * My_Controller will be used for all the CRUD operations in the system.
 *
 * All the other models should be extend form My_Model
 * Most of the common operations been written in the My_Model so that
 * programmer can easily call methods in My_Model Class for all most
 * all Database Communication and minimize the coding in their projects.
 *
 * @author     Dharshana Jayamaha <dharshana@openarc.lk>
 * @copyright  2013 RAD Team - OpenArc
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: 1.0
 * @link       http://pear.php.net/package/PackageName
 * @since      Class available since Release 1.0.0
 */
class MY_Controller extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->data['errors'] = array();
        $this->data['site_name'] = config_item('site_name');
    }

    /**
     * Purpose of the function is to Send SMS using 'SKY_MESSENGER'
     * Function uses CURL and sending single SMS for the difine number
     *
     * @param  Text     $phoneNumber    Telephone number without Country name. 773443344
     * @param  Text     $smsCotent      SMS content/message.
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return TRUE if message send Successfully or FALSE if sending failed.
     */
    public function curlWithSms($phoneNumber, $smsCotent)
    {
        //get cURL resource
        $curl = curl_init();
        //set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://sms.openarc.lk/api.do?type=SMS:TEXT:INDIVIDUAL&action=SEND&priority=2&username=openlib&password=iaTeQTKFh7KD3FR&recipient=94-'.$phoneNumber.'&messagedata='.$smsCotent.'&signature=1',
            CURLOPT_USERAGENT => 'Openlib sysem massage'
        ));
        //send the request & save response to $resp
        $resp = curl_exec($curl);
        // close request to clear up some resources
        curl_close($curl);

        //get the xml curl result
        $xml_object = simplexml_load_string($resp);

        $xml_array  = $this->object2array($xml_object);

        //check the json result is true or false
        if(isset($xml_array['code']) && ($xml_array['code']=='000'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * this function will be called to send email
     *
     * @param  String   $to         Receiver's email address
     * @param  String   $subject    Email Subject
     * @param  String   $message    Email Message
     * @param  String   $fromEmail  Sender's Email address, default set to 'noreply@openarconline.com'
     * @param  String   $fromName   Senders's Name, default set to 'RAD Notification'
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return TRUE if message send and FALSE if Failed.
     */
    public function sendEmail($to, $subject, $message, $fromEmail = 'noreply@openarconline.com' , $fromName = "RAD Notification")
    {
        //$this->load->library('email', $this->emailConfig);
        // 'crmdemo@openarconline.com';

        $this->load->library('email');

        $this->email->set_newline("\r\n");
        $this->email->from($fromEmail, $fromName);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if($this->email->send())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * this function will be called to send MASS emails
     *
     * @param  Array()   $to          Array receivers' Email address
     * @param  String    $subject     Email Subject
     * @param  String    $message     Email Message
     * @param  String    $fromEmail   Sender's Email Address, default set to 'noreply@openarconline.com'
     * @param  String    $fromName    Sender's Name, default set to 'RAD Notification'
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return NO returns
     */
    public function sendMassEmail($to, $subject, $message, $fromEmail = "noreply@openarconline.com", $fromName = "RAD Notification")
    {
        foreach($to as $recipient)
        {
            if($this->sendEmail($recipient, $subject, $message, $fromEmail, $fromName)){
                //echo 'Email Send';
            }else{
                //echo 'NOT Send';
            }
        }

    }

    /**
     * this function return and download data from database by query
     *
     * @param  Array()   $queryData   codeigniter query return
     * @param  Bool      $headers     data table headlines will be table flied names
     * @param  String    $filename    download file name
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return NO returns
     */
    public function toCSV($queryData, $headers=TRUE, $filename='data.csv'){
        query_to_csv($queryData, $headers, $filename);
    }

    /**
     * this function saves new sorting  order
     *
     * @param  json   JsonObject   Ajax pass
     * @param  String    $filename    download file name
     * @throws Some_Exception_Class If something interesting cannot happen
     * @return NO returns
     */
    public function save_order($oderjson= NULL)
    {

        $new_oder_json = $this->input->post('oderjson');
        $modal_name =  $this->input->post('modal').'_m';
        echo $modal_name;

        if ($new_oder_json == NULL) {

        } else {

            echo $new_oder_json;

            $new_oder = json_decode($new_oder_json);

            foreach ($new_oder as $id => $data) {
                $this->$modal_name->save(array(
                    'order_column'=>$data),$id);
            }

        }

    }
}
