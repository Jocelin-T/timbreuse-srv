<?php

namespace Timbreuse\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use Timbreuse\Models\EventPlanningsModel;
use Timbreuse\Models\EventTypesModel;
use Timbreuse\Models\UserGroupsModel;
use Timbreuse\Models\UsersModel;
use User\Models\User_model;

class PersonalEventPlannings extends BaseController
{
    // Class properties
    private EventPlanningsModel $eventPlanningsModel;
    private EventTypesModel $eventTypesModel;
    private UsersModel $userSyncModel;
    private User_model $userModel;

    /**
     * Constructor
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        // Set Access level before calling parent constructor
        // Accessibility reserved to admin users
        $this->access_level = config('\User\Config\UserConfig')->access_lvl_registered;
        parent::initController($request, $response, $logger);

        // Load required helpers
        helper('form');

        // Load required models
        $this->eventPlanningsModel = new EventPlanningsModel();
        $this->eventTypesModel = new EventTypesModel();
        $this->userGroupsModel = new UserGroupsModel();
        $this->userSyncModel = new UsersModel();
        $this->userModel = new User_model();
    }

    /**
     * Display the event plannings list
     *
     * @return string
     */
    public function index(?int $timUserId = null) : string {
        if (is_null($timUserId) && !url_is('*admin*')) {
            $user = $this->userModel
                ->join('access_tim_user', 'access_tim_user.id_ci_user = user.id', 'left')
                ->find($_SESSION['user_id']);

            $timUserId = $user['id_user'] ?? null;
        }

        $data['title'] = lang('tim_lang.event_plannings_list');
        $data['list_title'] = ucfirst(lang('tim_lang.event_plannings_list'));
        $data['isVisible'] = true;
        $data['route'] = '';

        $data['columns'] = [
            'event_date' => ucfirst(lang('tim_lang.field_event_date')),
            'start_time' => ucfirst(lang('tim_lang.field_start_time')),
            'end_time' => ucfirst(lang('tim_lang.field_end_time')),
            'is_work_time' => ucfirst(lang('tim_lang.field_is_work_time_short')),
        ];

        $eventPlannings = $this->eventPlanningsModel->where('fk_user_sync_id', $timUserId)->findAll();

        $data['items'] = array_map(function($eventPlanning) {
            return [
                'id' => $eventPlanning['id'],
                'event_date' => $eventPlanning['event_date'],
                'start_time' => $eventPlanning['start_time'],
                'end_time' => $eventPlanning['end_time'],
                'is_work_time' => $eventPlanning['is_work_time'] ? lang('common_lang.yes') : lang('common_lang.no'),
            ];
        }, $eventPlannings);

        $data['url_create'] = "event-plannings/group/create";
        $data['url_update'] = 'event-plannings/update/';
        $data['url_delete'] = 'event-plannings/delete/';

        return $this->display_view([
            'Timbreuse\Views\common\return_button',
            'Common\Views\items_list'], $data);
    }

    /**
     * Display the create form
     *
     * @return string|RedirectResponse
     */
    public function createPersonal(?int $userId = null) : string|RedirectResponse {
        $eventTypes = $this->eventTypesModel->where('is_personal_event_type', true)->findAll();
        $user = null;

        if (!is_null($userId)) {
            $user = $this->userSyncModel->find($userId);
        }

        $data = [
            'title' => lang('tim_lang.create_event_planning_title'),
            'eventPlanning' => null,
            'sessionEventPlanning' => session()->get('eventPlanningPostData'),
            'eventTypes' => $this->mapForSelectForm($eventTypes),
            'user' => $user
        ];

        session()->remove('eventPlanningPostData');

        if (isset($_POST) && !empty($_POST)) {
            if ($this->checkButtonClicked('select_linked_user')) {
                return redirect()->to(base_url('admin/users/select?path=admin/event-plannings/personal/create/'));
            }

            $data['errors'] = $this->getPostDataAndSaveEventPlanning();

            if (empty($data['errors'])) {
                return redirect()->to(base_url('admin/event-plannings'));
            }
        }

        return $this->display_view([
            'Timbreuse\Views\eventPlannings\event_tabs',
            'Timbreuse\Views\eventPlannings\personal\save_form',
            'Timbreuse\Views\eventPlannings\get_event_series_form'], $data);
    }
    
    /**
     * Display the delete form and delete the corresponding event planning
     *
     * @param  int $id
     * @param  int $action
     * @return string|RedirectResponse
     */
    public function delete(int $id, int $action = 0) : string|RedirectResponse {
        $eventPlanning = $this->eventPlanningsModel->find($id);

        if (!$eventPlanning) {
            return redirect()->to(base_url('admin/event-plannings'));
        }

        $data = [
            'title' => lang('tim_lang.delete_event_planning'),
            'eventPlanning' => $eventPlanning
        ];

        switch ($action) {
            case 0:
                return $this->display_view('Timbreuse\Views\eventPlannings\confirm_delete', $data);

            case 1:
                // In case soft delete is implemented
                break;
            
            case 2:
                if (isset($_POST) && !empty($_POST) && !is_null($_POST['confirmation'])) {
                    $this->eventPlanningsModel->delete($id, true);
                }
                break;
        }

        return redirect()->to(base_url('admin/event-plannings'));
    }

    /**
     * Retrieves post data from the request and saves the event planning information
     *
     * @return array Validation errors encountered during the saving process
     */
    protected function getPostDataAndSaveEventPlanning() : array {
        // todo: Save event serie and get id of saved + errors
        $eventPlanning = [
            'id' => $this->request->getPost('id'),
            'fk_event_series_id' => null,
            'fk_user_group_id' => $this->request->getPost('linked_user_group_id') ?? null,
            'fk_user_sync_id' => $this->request->getPost('linked_user_id') ?? null,
            'fk_event_type_id' => $this->request->getPost('fk_event_type_id'),
            'event_date' => $this->request->getPost('event_date'),
            'start_time' => $this->request->getPost('start_time'),
            'end_time' => $this->request->getPost('end_time'),
            'is_work_time' => (bool)$this->request->getPost('is_work_time'),
        ];

        $this->eventPlanningsModel->save($eventPlanning);
        return $this->eventPlanningsModel->errors();
    }

    protected function mapForSelectForm($array) : array {
        return array_combine(array_column($array, 'id'), array_map(function($row) {
            return $row['name'];
        }, $array));
    }

    /**
     * Check if selectParentButton has been clicked
     * Save post data on true
     *
     * @return bool
     */
    protected function checkButtonClicked(string $buttonName) : bool {
        $selectParentUserGroup = boolval($this->request->getPost($buttonName));

        if ($selectParentUserGroup) {
            $this->savePostDataToSession('eventPlanningPostData');
        }

        return $selectParentUserGroup;
    }
    
    /**
     * Save post data in the user session
     *
     * @return void
     */
    protected function savePostDataToSession(string $key) : void {
        session()->set($key, $this->request->getPost());
    }
}
