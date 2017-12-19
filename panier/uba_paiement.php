<?php
/**
 *
 * This package provides a means of performing a Remote Procedure(RPC) call 
 *using PHP CURL. It is intended for use with merchants who are integrating
 * with the Central Internet Payment Gateway(CIPG)
 * use of HTTPRequest to perform server communication functions - data can
 * be sent from a form to a remote URL which returns a response which can 
 * then be used to determine other actions to take 
 *
 * All strings should be in ASCII or UTF-8 format!
 *
 *The script majorly receives Transaction POST data from a form and 
 *then sends the data to a URL to register it
 *It then afterwards redirects to the URL to pay for the Transaction
 *if registration was succesfull.
 *
 * LICENSE: Use of This Application is only intended as a guide
 *fr merchant's currently integrating into the UBA CIPG payment
 *gateway and should not be used otherwise
 *
 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN
 * NO EVENT SHALL CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
 * OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
 * TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
 * USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 *
 * @category
 * @package     com.itex.cipg.testmerchantsite
 * @author      JohnTheBeloved
  * @author     Banky Alani
 * @copyright   ITEX Integrated Systems 
 * @version     postjson.php,v 1.31 2013/11/22 04:30 
 * @link      
 */
//Import /Include the file where the URL for CIPG is declared
require_once('settings.php');
$id=$_REQUEST["sys_paie"];
//Declare the Variables to POST to CIPG for registration of this Transaction in an array
$post= array(
"merchantId" => CIPG_MERCHANTID,
"description" => $_REQUEST["description"],
//"total" => $_REQUEST["amount"] * $_REQUEST["noOfItems"],
"total" => $_REQUEST["total"],
"date" => $_REQUEST["date"],
"countryCurrencyCode" => $_REQUEST["countryCurrencyCode"],
"noOfItems" => $_REQUEST["noOfItems"],
"customerFirstName" => $_REQUEST["customerFirstName"],
"customerLastname" => $_REQUEST["customerLastname"],
"customerEmail" => $_REQUEST["customerEmail"],
"customerPhoneNumber" => $_REQUEST["customerPhoneNumber"],
"referenceNumber" => $_REQUEST["referenceNumber"],
"serviceKey" => CIPG_SERVICEKEY,
);

//Initialise connection using PHP CURL
$ch = curl_init();

//The variable -- CIPG_URL_REGISTER_POST is being declared in the settings.php file included
$REGISTER_CIPG_TXN_URL = CIPG_URL_REGISTER_POST_PARAM;

//set option of URL to post to
curl_setopt($ch, CURLOPT_URL, $REGISTER_CIPG_TXN_URL);
//set option of request method -----HTTP POST Request
curl_setopt($ch, CURLOPT_POST, true);
//The HTTP authentication methods to use
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
//set to true if cipg url is via https
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

//This line sets the parameters to post to the URL
curl_setopt($ch, CURLOPT_POSTFIELDS,  $post); 
//This line makes sure that the response is gotten back to the $response object(see below) and not echoed
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//This line excecutes the RPC call 

$response = curl_exec($ch); //and assigns the result to $response object
 $returnCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);


//Close the stream
curl_close($ch);
 
 /** PARTIE ORIGINAL DU CODE DE L'API D'UBA********
 
//Check if there are no errors ie httpresponse == 200 -OK
if ($returnCode == 200) {

	//If there are no errors, the transaction ID is returned
	$transactionid = $response;
	//This line declares the Link to pay for this transaction
    $paylink = CIPG_URL_PAY ."?id=" . $transactionid;
	header( "Location: $paylink");

} else {
	//Get return Error Code, If there was an error during call
    //
    switch($returnCode){
    	//200 is OK so, this should be insignificant if all is well
        case 200:

            break;
        default:
        //Declare the Request Error
            $result = 'HTTP ERROR -> ' . $returnCode;

            break;
    }
    echo $result;

}

**************************** FIN PARTIE ORIGINAL*/

/*******************************************************************************

***************** INTEGRATION DU CODE TEST *************************************

********************************************************************************/

if ($returnCode == 404) {
	$ttt = time();
	$cod_act = mt_rand(100, 999) ; $cod = $cod_act."".$ttt."1" ;
	//If there are no errors, the transaction ID is returned
	$transactionid = 'CTXN'.$cod;
	//This line declares the Link to pay for this transaction
    $paylink ="confirmation_paiement_OK.php?id=" . $transactionid;
	$ref_cmd=$_REQUEST["referenceNumber"];
	$dd=$_REQUEST["jjjj"];
	
	header("Location: confirmation_paiement.php?dcassdsdssadascasascasd=$dd&ssjdsdjfcsdjcvbsdkcvbsdbcvjsdjsdksdjsdjbsdjks=$paylink&sdsasdsacfdsdsfcd=$id&odfojvfsdjvufdvnfvu=$ref_cmd");
	
	}
?>