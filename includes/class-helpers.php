<?php

namespace STI\SemantifyIt\Includes;


class Helpers
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    public $config;

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }


    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }


    public function securityCheck($POST)
    {

        if (!check_ajax_referer( 'semantify_it_ajax', '_wpnonce_semantify_it' )){
            $this->displayMessage("error", __('CRSF Forgery! Somebody is trying to alter your data! The action was not executed.', $this->plugin_name));
            exit;
            die();
        }


        //var_dump($POST);

        if (count(@$POST["data"]) == 0) {
            $this->displayMessage("notice", __('No data received. Something is wrong. Please contact us by email info@semantify.it', $this->plugin_name));
        }

    }

    public function displayMessage($type, $message)
    {

        $class = "";
        switch ($type) {
            case "notice":
                $class = "snotice snotice-warning";
                break;

            case "error":
                $class = "serror serror-warning";
                break;

            case "success":
                $class = "snotice snotice-success";
                break;

            case "info":
                $class = "snotice snotice-info";
                break;
        }


        echo '<div class="' . $class . '"><p>' . $message . '</p></div>';
    }

    public function makeList($annotations,$annotationID)
    {
        $list = "";
        $last = "";

        //var_dump($annotations);

        foreach ($annotations as $annotation) {
            /* section by types */
            if ($annotation[1] == '--div--') {
                if ($last != "") {
                    $list .= '</optgroup>';
                }

                if ($annotation[0] == '') {
                    $annotation[0] = __('Uncategorised', $this->plugin_name);
                }

                $list .= '<optgroup label="' . $annotation[0] . '">';
                $last = $annotation[1];
                continue;
            }
            $list .= '<option value="' . $annotation[1] . '" ' . ($annotation[1] == $annotationID ? 'selected' : '') . '>' . $annotation[0] . '</option>';

        }
        if ($last != "") {
            $list .= '</optgroup>';
        }

        return $list;

    }


    public function saveContent($slug, $content)
    {


        if (@$this->config["type"] == "meta") {
            if (!$this->isContentSaved($slug)) {
                $out = add_post_meta($this->config["postid"], $this->plugin_name . "-" . $slug, $content, true);
            } else {
                $out = update_post_meta($this->config["postid"], $this->plugin_name . "-" . $slug, $content);
            }
        } else {
            if (!$this->isContentSaved($slug)) {
                $out = add_option($this->plugin_name . "-" . $slug, $content);
            } else {
                $out = update_option($this->plugin_name . "-" . $slug, $content);
            }
        }

        if ($out === false) {
            return false;
        } else {
            return true;
        }
    }

    public function deleteContent($slug)
    {

        if (@$this->config["type"] == "meta") {
            return delete_post_meta($this->config["postid"], $this->plugin_name . "-" . $slug);
        } else {
            return delete_option($this->plugin_name . "-" . $slug);
        }
    }

    public function loadContent($slug)
    {

        if (@$this->config["type"] == "meta") {
            $raw = get_post_meta($this->config["postid"], $this->plugin_name . "-" . $slug, true);
        } else {
            $raw = get_option($this->plugin_name . "-" . $slug);
        }

        //echo "content:".$raw;

        if ($raw === false) {
            return false;
        } else {
            return $raw;
        }

    }

    public function isContentSaved($slug)
    {

        if (@$this->config["type"] == "meta") {
            $raw = get_post_meta($this->config["postid"], $this->plugin_name . "-" . $slug, true);
        } else {
            $raw = get_option($this->plugin_name . "-" . $slug);
        }



        if ($raw === false) {
            return false;
        } else {
            return true;
        }
    }

}