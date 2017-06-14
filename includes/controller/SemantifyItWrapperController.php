<?php
namespace STI\SemantifyIt\Controller;

use \STI\SemantifyIt\Domain\Model\SemantifyItWrapper;

/**
 * SchemantifyItController
 */
class SemantifyItWrapperController
{

    /**
     * @var \STI\SemantifyIt\Domain\Model\SemantifyItWrapper
     */
    public $model;

    public $plugin_name;
    public $plugin_version;


    /**
     * displaying warnings
     *
     * @var bool
     */
    private $warnings = false;


    /**
     * SemantifyItWrapperController constructor.
     *
     * @param string $key
     */
    function __construct($key="")
    {

        if($key!=""){
            $this->model = new SemantifyItWrapper($key);
        }else{
            $this->model = new SemantifyItWrapper();
        }
    }

    /**
     * @return \STI\SemantifyIt\Domain\Model\SemantifyItWrapper
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param \STI\SemantifyIt\Domain\Model\SemantifyItWrapper $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }



    /**
     * registering warning message
     *
     * @param $message
     */
    private function registerWarning($message)
    {
        if ($this->warnings) {
            $this->displayMessage($message, "warning");
        }

    }

    /**
     * displayin message
     *
     * @param $message
     */
    private function displayMessage($message, $type)
    {
        echo "<br/><br/><div >".$type ." ". $message . "</div>";

    }


    /**
     *
     * sorting array
     *
     * @param $a
     * @param $b
     * @return int
     */
    private static function type_sort($a, $b)
    {
        sort($a->type);
        sort($b->type);

        $typeA = implode(" ", $a->type);
        $typeB = implode(" ", $b->type);

        if ($typeA > $typeB) {
            return -1;
        } else {
            if ($typeA < $typeB) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    public function isApiKeyValid(){
        $json = $this->model->getAnnotationList();
        $content = @json_decode($json);
        if ((!$json) || (isset($content->message))) {
            return false;
        }
        return true;
    }

    public function isURLAnnotationAvailable($url){
        $json = $this->model->getAnnotationByURL($url);
        $content = @json_decode($json);
        if ((!$json) || (isset($content->message) || (trim($json)=="{}"))) {
            return false;
        }
        return true;
    }


    /**
     *
     * get list of annotations based on key
     *
     * @return mixed
     */
    public function getAnnotationList()
    {
        $annotationList[] = array(
            "Choose your annotation",
            ""
        );
        $annotationList[] = array(
            "None annotation",
            "0"
        );

        /*
        $annotationList[] = array(
            "Make or edit a new annotation",
            "1"
        );
        */

        $json = $this->model->getAnnotationList();

        //if no data received
        if (!$json) {
            $this->registerWarning("Could not load stuff from the URL");

            return $annotationList;
        }
        $annotationListFromAPI = json_decode($json);

        if ((isset($annotationListFromAPI->message))) {
            return $annotationList;
        }

        //echo is_array($annotationListFromAPI);
        //var_dump($annotationListFromAPI);

        //if there is no error
        if ((@$annotationListFromAPI->error == "") && ($json != false)) {
            //var_dump($annotationListFromAPI);

            $last = "";
            /* if we have a more types, then we sort them */
            usort($annotationListFromAPI, array($this, 'type_sort'));

            foreach ($annotationListFromAPI as $item) {

                if ($item->UID == "") {
                    break;
                }

                /* make an identifier wit them */
                //var_dump($item->Type);
                $type = implode(" ",$item->type);
                /* add selection break */
                if ($last != $type) {
                    $annotationList[] = array($type, '--div--');
                    $last = $type;
                }

                $annotationList[] = array($item->name, $item->UID);
            }
        } else {
            $this->registerWarning($annotationListFromAPI->error);
        }

        //var_dump($annotationList);

        return $annotationList;
    }

    /**
     *
     * function which construct an annotation
     *
     * @param $data
     */
    private function constructAnnotation($data)
    {
        //class choosen by type
        $class = '\\STI\\SemantifyIt\\Domain\\Repository\\'.$data['@type'];
        $method = 'getAnnotation';
        //call the class method
        return call_user_func_array(array($class, $method), array($data));
    }


    /**
     * @param $annotation
     * @param $uid
     * @return mixed
     */
    public function updateAnnotation($annotation, $uid){
        $response =  $this->model->updateAnnotation($annotation, $uid);
        $id = $this->extractID($response);
        return $id;
    }

    /**
     *
     * function for posting annotation
     *
     * @param $annotation
     * @return mixed
     */
    public function postAnnotation($annotation){
        $response =  $this->model->postAnnotation($annotation);
        $id = $this->extractID($response);
        return $id;
    }


    /**
     *
     * getting annotation by id
     *
     * @param $annotation
     * @return \STI\SemantifyIt\json
     */
    public function getAnnotation($annotation){
        $response =  $this->model->getAnnotation($annotation);
        return $response;
    }

    /**
     *
     * getting annotation by url
     *
     * @param $url
     * @return string
     */
    public function getAnnotationByURL($url){
        $response =  $this->model->getAnnotationByURL($url);
        return $response;
    }




    /**
     * @param $response
     * @return mixed
     */
    private function extractID($response){
        $fields = json_decode($response);
        if(!isset($fields->UID)){
            return false;
        }
        return $fields->UID;
    }


    /**
     *
     * function which is called to create and handle anotations
     *
     *
     * @param $fields
     * @param $other
     */
    public function createAnnotation($fields, $other)
    {
        //$this->initialize($other['id']);
        $data = $this->createData($fields, $other);
        $jsonld = $this->constructAnnotation($data);
        //$this->deinitialize();
        return $jsonld;
    }


    /**
     *
     * function which makes a mapping to data array which is after that send to construct annotation
     *
     * @param $fields
     * @param $other
     * @return array
     */
    private function createData($fields, $other){
        $data = array();
        $data['dateModified'] = $other['dateModified'];
        $data['dateCreated'] = $other['dateCreated'];
        $data['@type'] = $fields['semantify_it_annotationNew_StepOne'];
        $data['@about'] = $fields['semantify_it_annotationNew_StepTwo'];
        $data['@aboutName'] = $fields['semantify_it_annotationNew_Name'];
        $data['@aboutURL'] = $fields['semantify_it_annotationNew_URL'];
        $data['id'] = $other['id'];
        $data["url"] = PagePathApi::getPagePath($data['id']);
        $data['headline'] = $fields['title'];
        $data['nav_title'] = $fields['nav_title'];
        $data['subtitle'] = $fields['subtitle'];
        $data['tstamp'] = $other['tstamp'];
        $data['name'] = $other['name'];
        $data['email'] = $other['email'];
        return $data;
    }

    public function cover_annotation_into_html($annotation){

        $out="";
        $out.= '<!-- Great, right? Created with semantify.it -->
            ';
        $out.= '<script type="application/ld+json">';
        $out.= $annotation;
        $out.= '</script>';

        return $out;

    }



}