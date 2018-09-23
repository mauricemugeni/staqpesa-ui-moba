<?php

require_once WPATH . "modules/classes/Users.php";
require_once WPATH . "modules/classes/Settings.php";

class System_Administration extends Database {

    public function execute() {
        if ($_POST['action'] == "add_system_privilege") {
            return $this->addSystemPrivilege();
        } else if ($_POST['action'] == "add_system_component") {
            return $this->addSystemComponent();
        } else if ($_POST['action'] == "edit_system_privilege") {
            return $this->editSystemPrivilege();
        } else if ($_POST['action'] == "edit_user_type_privilege") {
            return $this->editUserTypePrivilege();
        } else if ($_POST['action'] == "edit_system_component") {
            return $this->editSystemComponent();
        } else if ($_POST['action'] == "add_privilege_to_role") {
            return $this->addPrivilegeToRole();
        }
    }

    private function sendHttpRequestPost($data_string) {
        $settings = new Settings();
        return $settings->sendHttpRequestPost($data_string);
    }

    private function sendHttpRequestGet($data_string) {
        $settings = new Settings();
        return $settings->sendHttpRequestGet($data_string);
    }

    private function sendHttpRequestPut($data_string) {
        $settings = new Settings();
        return $settings->sendHttpRequestPut($data_string);
    }

    public function searchSystem($request_type, $search_input) {
        $data['request_type'] = $request_type;
        $data['search_input'] = $search_input;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Adding functions ************************************************************** */
    private function addPrivilegeToRole() {
        $data['request_type'] = $_POST['action'];
        $data['role'] = $_POST['role'];
        $data['privilege'] = $_POST['privilege'];
        $data['createdby'] = $_POST['createdby'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['role']) && !empty($data['privilege']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addSystemPrivilege() {
        
//        $sql = "INSERT INTO system_privileges (name, component, createdat, createdby, lastmodifiedat, lastmodifiedby)"
//                . " VALUES (:name, :component, :createdat, :createdby, :lastmodifiedat, :lastmodifiedby)";
//        $stmt = $this->prepareQuery($sql);
//        $stmt->bindValue("name", strtoupper($_POST['name']));
//        $stmt->bindValue("component", $_POST['component']);
//        $stmt->bindValue("createdat", time());
//        $stmt->bindValue("createdby", $_POST['createdby']);
//        $stmt->bindValue("lastmodifiedat", time());
//        $stmt->bindValue("lastmodifiedby", $_POST['createdby']);
//        $stmt->execute();
//        return true;
        
        
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['component'] = $_POST['component'];
        $data['createdby'] = $_POST['createdby'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['component']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function addSystemComponent() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['acronym'] = $_POST['acronym'];
        $data['createdby'] = $_POST['createdby'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['acronym']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    /** Fetching all functions ************************************************************** */
    public function getSystemComponents() {
//        $data['request_type'] = 'get_system_components';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];

//        $stmt = $this->prepareQuery("SELECT id, name, status FROM system_components WHERE status=1011 "
//                . "OR status=1021 OR status=1031 ORDER BY id ASC");
        $stmt = $this->prepareQuery("SELECT id, name, status FROM system_components ORDER BY id ASC");
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['system_component']) && $_POST['system_component'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            } else {
                if (!empty($_POST['system_component']) && $_POST['system_component'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//            }
//        }
        if ($html == "") {
            $html = "<option value=\"\">No component entered into the database!</option>";
        }
        echo $html;
        return $currentGroup;
    }

    public function getSystemPrivileges() {
        
//        $stmt = $this->prepareQuery("SELECT id, name, status FROM system_privileges WHERE status=1011 "
//                . "OR status=1021 OR status=1031 ORDER BY name ASC");
        
        $stmt = $this->prepareQuery("SELECT id, name, status FROM system_privileges WHERE status=1011 "
                . "OR status=1021 OR status=1031 ORDER BY id ASC");
        $stmt->execute();
        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        
//        $data['request_type'] = 'get_system_privileges';
//        $data_string = http_build_query($data);
//        $process_request = $this->sendHttpRequestPost($data_string);
//        $decoded_response = json_decode($process_request, true);
//        $info = $decoded_response['message'];
        $currentGroup = null;
        $html = "";
        foreach ($info as $row) {
            if (is_null($currentGroup)) {
                $currentGroup = $row['name'];
                if (!empty($_POST['system_privilege']) && $_POST['system_privilege'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
//                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    $html .= "<option value=\"{$row['id']}\">{$row['id']}</option>";
                }
            } else {
                if (!empty($_POST['system_privilege']) && $_POST['system_privilege'] == $row['id']) {
                    $html .= "<option value=\"{$row['id']}\" selected='selected'>{$row['name']}</option>";
                } else {
//                    $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
                    $html .= "<option value=\"{$row['id']}\">{$row['id']}</option>";
                }
            }
        }

//        foreach ($info as $row) {
//            if (is_null($currentGroup)) {
//                $currentGroup = $row['name'];
//                $html .= "<option value=\"{$row['id']}\" selected>{$row['name']}</option>";
//            } else {
//                $html .= "<option value=\"{$row['id']}\">{$row['name']}</option>";
//            }
//        }
        if ($html == "") {
            $html = "<option value=\"\">No privilege entered into the database!</option>";
        }
        echo $html;
        return $currentGroup;
    }

    public function getAllSystemComponents() {

//        $sql = "SELECT * FROM system_components ORDER BY id ASC";
//        $stmt = $this->prepareQuery($sql);
//        $stmt->execute();
//        $info = $stmt->fetchAll(PDO::FETCH_ASSOC);
//        return $info;

        $data['request_type'] = 'get_all_system_components';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllSystemPrivileges() {
        $data['request_type'] = 'get_all_system_privileges';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllUserPrivileges() {
        $data['request_type'] = 'get_all_user_privileges';
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Fetching details functions ************************************************************** */
    public function fetchSystemPrivilegeDetails($code) {
        $data['request_type'] = 'fetch_system_privilege_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchUserPrivilegeDetails($code) {
        $data['request_type'] = 'fetch_user_privilege_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function fetchSystemComponentDetails($code) {
        $data['request_type'] = 'fetch_system_component_details';
        $data['code'] = $code;
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Editing functions ************************************************************** */
    private function editSystemPrivilege() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['system_privilege'];
        $data['name'] = $_POST['name'];
        $data['component'] = $_POST['component'];
        $data['createdby'] = $_POST['createdby'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['name']) && !empty($data['component']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editUserTypePrivilege() {
        $data['request_type'] = $_POST['action'];
        $data['name'] = $_POST['name'];
        $data['createdby'] = $_POST['createdby'];
        $data['component'] = $_POST['component'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['name']) && !empty($data['createdby']) && !empty($data['component'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    private function editSystemComponent() {
        $data['request_type'] = $_POST['action'];
        $data['id'] = $_SESSION['system_component'];
        $data['name'] = $_POST['name'];
        $data['acronym'] = $_POST['acronym'];
        $data['createdby'] = $_POST['createdby'];
        $data_string = http_build_query($data);
        if (!empty($data['request_type']) && !empty($data['id']) && !empty($data['name']) && !empty($data['acronym']) && !empty($data['createdby'])) {
            $process_request = $this->sendHttpRequestPost($data_string);
            if ($process_request) {
                $decoded_response = json_decode($process_request, true);
                $response['status'] = $decoded_response['status'];
                $response['message'] = $decoded_response['message'];
            } else {
                $response['status'] = 400;
                $response['message'] = "Sorry: There was an error processing the request. Please try again later";
            }
        } else {
            $response['status'] = 400;
            $response['message'] = "Error: Missing Values in Request";
        }
        return $response;
    }

    /** Updating functions ************************************************************** */
    public function updateSystemPrivilege($code, $update_type) {
        $data['request_type'] = 'update_system_privilege';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateUserTypePrivilege($code, $update_type) {
        $data['request_type'] = 'update_user_type_privilege';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateSystemComponent($code, $update_type) {
        $data['request_type'] = 'update_system_component';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function updateRolePrivilege($code, $update_type) {
        $data['request_type'] = 'update_role_privilege';
        $data['code'] = $code;
        $data['update_type'] = $update_type;
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPut($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    /** Adding functions ************************************************************** */
    public function getAllSystemPrivilegeNotifications() {
        $data['request_type'] = 'get_all_system_privilege_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

    public function getAllSystemComponentNotifications() {
        $data['request_type'] = 'get_all_system_component_notifications';
        $data['userid'] = $_SESSION['userid'];
        $data_string = http_build_query($data);
        $process_request = $this->sendHttpRequestPost($data_string);
        $decoded_response = json_decode($process_request, true);
        $info = $decoded_response['message'];
        return $info;
    }

}
