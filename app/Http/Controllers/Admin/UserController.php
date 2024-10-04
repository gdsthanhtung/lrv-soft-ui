<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\UserModel as MainModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Http\Requests\UserRequest as MainRequest;
use App\Helpers\Notify;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Config;
use App\Helpers\FilterList;

class UserController extends Controller
{
    private $mainModel;
    private $pathView;
    private $pathViewTemplate;
    private $moduleName = "user";
    private $pageTitle = "User";
    private $ctrl = '';

    public function __construct(){
        $this->mainModel = new MainModel();
        $this->pathView = "modules.$this->moduleName.";
        $this->pathViewTemplate = "templates.";
        $this->ctrl = Config::get("gds.route.$this->moduleName.ctrl");

        View::share([
            'ctrl' => $this->ctrl,
            'pathView' => $this->pathView,
            'pathViewTemplate' => $this->pathViewTemplate,
            'pageTitle' => $this->pageTitle
        ]);
    }

    private function getPathView(string $file = 'index'){
        return $this->pathView.$file;
    }

    //=====================================================

    public function show(Request $rq)
    {
        $moduleFilter = [
            "status" => $rq->input('status', 'all')
        ];
        FilterList::checkClear($rq, $this->ctrl);
        $params = FilterList::export($rq, $this->ctrl, $moduleFilter);
        $params["searchFieldAccepted"] = Config::get("gds.enum.selectionInModule.".$this->moduleName);

        $data = $this->mainModel->listItems($params, ['task' => 'admin-list-items']);

        if ($data) {
            $dataArray = $data->toArray()['data']; // Convert paginated data to array
            $userIds = array_column($dataArray, 'id');
            $roleUsers = $this->mainModel->getRoleUsers($userIds);

            foreach ($dataArray as $key => $user) {
                if (isset($roleUsers[$user['id']])) {
                    $dataArray[$key]['role'] = $roleUsers[$user['id']]['dataForShow'];
                } else {
                    $dataArray[$key]['role'] = null; // Handle case where role data is missing
                }
            }

            // Update the original paginated data with the modified array
            $data->setCollection(collect($dataArray));
        }

        $shareData = [
            'data' => $data,
            'params' => $params
        ];
        return view($this->getPathView('index'), $shareData);
    }

    public function form(Request $rq)
    {
        $data = [];
        $id = $rq->id;

        if($id){
             $params = [
                'id'    => $id
            ];
            $data = $this->mainModel->getItem($params, ['task' => 'get-item']);
        }

        if(!$data && $id)
            return redirect()->route($this->moduleName)->with('notify', ['type' => 'danger', 'message' => $this->pageTitle.' id is invalid!']);

        //Get list role
        $roleModel = new RoleModel();
        $dataRole = $roleModel->listItems([], ['task' => 'admin-list-items-to-select']);

        //Get user's role
        $roleUser = ($id) ? $this->mainModel->getRoleUsers([$id])[$id] : [];

        $shareData = [
            'data' => $data,
            'id' => $id,
            'dataRole' => $dataRole,
            'roleUser' => $roleUser
        ];
        return view($this->getPathView('form'), $shareData);

    }

    public function delete(Request $rq)
    {
        $params = [
            'id'    => $rq->id
        ];
        $rs = $this->mainModel->delete($params);
        return redirect()->route('admin.'.$this->moduleName)->with('notify', Notify::export($rs));
    }

    public function change_status(Request $rq)
    {
        $params = [
            'id'    => $rq->id,
            'status'  => $rq->status
        ];

        $rs = $this->mainModel->saveItem($params, ['task' => 'change-status']);
        return redirect()->route('admin.'.$this->moduleName)->with('notify', Notify::export($rs));

    }

    public function change_level(Request $rq)
    {
        $params = [
            'id'    => $rq->id,
            'level'  => $rq->level
        ];

        $rs = $this->mainModel->saveItem($params, ['task' => 'change-level']);
        return redirect()->route('admin.'.$this->moduleName)->with('notify', Notify::export($rs));

    }

    public function save(MainRequest $rq)
    {
        if($rq->method() == 'POST'){
            $params = $rq->all();

            $rs = $this->mainModel->saveItem($params, ['task' => $params['task']]);
        }
        return redirect()->route('admin.'.$this->moduleName)->with('notify', Notify::export($rs));
    }
}
