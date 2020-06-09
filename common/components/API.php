<?php
namespace common\components;
use yii\base\Component;
use \RecursiveIteratorIterator;
use \RecursiveArrayIterator;

class API extends Component
{
	static function getInputDataArray(&$data, $requiredFields = NULL)
    {
        // Make sure there is POST or GET data.
        if (!filter_input(INPUT_POST, 'data') && !filter_input(INPUT_GET, 'data'))
        {
            self::echoJsonError('ERROR: No data POST variable was sent');
            return NULL;
        }

        if (filter_input(INPUT_POST, 'data'))
            $data = json_decode(filter_input(INPUT_POST, 'data'), true);
        else
            $data = json_decode(filter_input(INPUT_GET, 'data'), true);

        //Problem with the json object
        if (json_last_error())
        {
            self::echoJsonError('ERROR: Improper json structure');
            return NULL;
        }

        $data = $data['data'];

        if (isset($requiredFields))
        {
            $errorMessage = self::validateRequiredFields($requiredFields, $data);

            if (isset($errorMessage))
            {
                self::echoJsonError($errorMessage);
                return NULL;
            }
        }

        return isset($data);
    }	
	
	static function echoJsonError($errorMessage, $friendlyMessage = NULL, $errorCode = 1)
    {
        if (!isset($friendlyMessage))
        {
            $friendlyMessage = "There was an error communicating with the service provider.  Please try your request again or contact technical support if this issue persists.";
        }

		$returnArray = array();
        $returnArray['error'] = $errorCode;
        $returnArray['errorFriendlyMessage'] = $friendlyMessage;
        $returnArray['errorMessage'] = $errorMessage;

        //ErrorLog::model()->add($errorMessage);

		return ($returnArray);
    }	
	
	static function validateRequiredFields($requiredFields, $data)
    {
        $errorMessage = NULL;

        foreach ($requiredFields as $requiredField)
        {
            $found = FALSE;

            // Iterate over the "leaves" of the array, in case of a multi-dimensional array.
            // This assumes the required field key names are unique!
            foreach (new RecursiveIteratorIterator(new RecursiveArrayIterator($data)) as $key => $value)
            {
                if ($requiredField == $key && isset($value))
                {
                    $found = TRUE;
                    break;
                }
            }

            if (!$found)
            {
                $errorMessage = "ERROR: the required attribute '$requiredField' is missing or not set!";
                break;
            }
        }

        return $errorMessage;
    }
	static function APICall()
	{
		$url = 'https://localhost/outboard/app/user-list';
		$ch = curl_init($url);       
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json')                                                                       
		);                                                                                                                   
                                                                                                                     
		$result = curl_exec($ch);

		$jsonData =  json_decode($result);
		return $jsonData;
	}
	
	
}
?>