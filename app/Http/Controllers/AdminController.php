<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Player;
use Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ********** Super Agent *********
    public function manageSuperAgent()
    {
        $superagents = User::with('roles')->whereIn("role", [2])->get();
        return view('admin.admin-super-agent.manage-super-agent', compact('superagents'));
    }

    public function addSuperAgent()
    {
        return view("admin.admin-super-agent.add-super-agent");
    }

    public function postSuperAgent(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'tele_id' => 'required|unique:users,telegram_id',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'win_commission' => 'required',
            'loss_commission' => 'required',
        ]);

        $user = new User();
        $user->sub_agent_id = $request->sub_agent_id;
        $user->role = 2;
        $user->name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telegram_id = $request->tele_id;
        $user->group_tele_id = $request->group_tele_id;
        $user->win_commission = $request->win_commission;
        $user->loss_commission = $request->loss_commission;

        $res = $user->save();

        if ($res) {
            return redirect()->route("manageSuperAgent")->with("success", "Super Agent has been added successfully.");
        } else {
            return redirect()->route("manageSuperAgent")->with("error", "Failed to add Super Agent.");
        }
    }

    public function editSuperAgent($id)
    {
        $users = User::find($id);
        return view("admin.admin-super-agent.edit-super-agent", compact("users"));
    }

    public function updateSuperAgent(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'tele_id' => 'required|unique:users,telegram_id,' . $id, // Ensure tele_id is unique in the
            //'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email,' . $id,
            'win_commission' => 'required',
            'loss_commission' => 'required',


        ]);

        $userfind = User::find($id);

        if (empty($userfind)) {
            return back()->with("failed", "Data not found");
        } else {

            if ($request->password) {
                $pass = Hash::make($request->password);
            } else {
                $pass = $userfind->password;
            }

            $userfind->name = $request->first_name;
            $userfind->email = $request->email;
            $userfind->telegram_id = $request->tele_id;
            $userfind->group_tele_id = $request->group_tele_id;
            $userfind->win_commission = $request->win_commission;
            $userfind->loss_commission = $request->loss_commission;
            $userfind->password = $pass;
            $userfind->role = 2;
            $userfind->save();

            return redirect()
                ->route("manageSuperAgent")
                ->with("success", "Super Agent has been updated successfully.");
        }
    }

    public function deleteSuperAgent($id)
    {
        $agent_id = $id;
        $deleteUser = User::find($agent_id);
        $res = $deleteUser->delete();
        if ($res == true) {
            return back()->with("success", "Super Agent has been deleted successfully.");
        } else {
            return back()->with("failed", "Data not deleted.");
        }
    }

    public function ViewSuperAgent($id)
    {
        $users = User::find($id);
        return view("admin.admin-super-agent.view-super-agent", compact("users"));
    }

    // ********** Master Agent *********
    public function manageMasterAgent($agentId = null)
    {
        // Assuming role is a field in the users table
        $query = User::with('roles')->where("role", 3);

        if ($agentId) {
            $query->where('sub_agent_id', $agentId);
        }
        $masteragents = $query->get();

        return view('admin.admin-master-agent.manage-master-agent', compact('masteragents'));
    }

    public function addMasterAgent()
    {
        $superagents = User::with('roles')->whereIn("role", [2])->get();
        return view("admin.admin-master-agent.add-master-agent", compact('superagents'));
    }

    public function postMasterAgent(Request $request)
    {
        $request->validate([
            'sub_agent_id' => 'required',
            'first_name' => 'required',
            'tele_id' => 'required|unique:users,telegram_id',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'win_commission' => 'required',
            'loss_commission' => 'required',
        ]);

        $user = new User();
        $user->sub_agent_id = $request->sub_agent_id;
        $user->role = 3;
        $user->name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telegram_id = $request->tele_id;
        $user->group_tele_id = $request->group_tele_id;
        $user->win_commission = $request->win_commission;
        $user->loss_commission = $request->loss_commission;

        $res = $user->save();

        if ($res) {
            return redirect()->route("manageMasterAgent")->with("success", "Master Agent has been added successfully.");
        } else {
            return redirect()->route("manageMasterAgent")->with("error", "Failed to add Master Agent.");
        }
    }

    public function editMasterAgent($id)
    {
        $users = User::find($id);
        $superagents = User::with('roles')->whereIn("role", [2])->get();
        return view("admin.admin-master-agent.edit-master-agent", compact("users", "superagents"));
    }

    public function updateMasterAgent(Request $request, $id)
    {
        $request->validate([
            'sub_agent_id' => 'required',
            'first_name' => 'required',
            'tele_id' => 'required|unique:users,telegram_id,' . $id,
            //'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email,' . $id,
            'win_commission' => 'required',
            'loss_commission' => 'required',


        ]);

        $userfind = User::find($id);

        if (empty($userfind)) {
            return back()->with("failed", "Data not found");
        } else {

            if ($request->password) {
                $pass = Hash::make($request->password);
            } else {
                $pass = $userfind->password;
            }
            $userfind->sub_agent_id = $request->sub_agent_id;
            $userfind->name = $request->first_name;
            $userfind->email = $request->email;
            $userfind->telegram_id = $request->tele_id;
            $userfind->group_tele_id = $request->group_tele_id;
            $userfind->win_commission = $request->win_commission;
            $userfind->loss_commission = $request->loss_commission;
            $userfind->password = $pass;
            $userfind->role = 3;
            $userfind->save();

            return redirect()
                ->route("manageMasterAgent")
                ->with("success", "Master Agent has been updated successfully.");
        }
    }

    public function deleteMasterAgent($id)
    {
        $agent_id = $id;
        $deleteUser = User::find($agent_id);
        $res = $deleteUser->delete();
        if ($res == true) {
            return back()->with("success", "Master Agent has been deleted successfully.");
        } else {
            return back()->with("failed", "Data not deleted.");
        }
    }

    public function ViewMasterAgent($id)
    {
        $users = User::find($id);
        $superagents = User::with('roles')->whereIn("role", [2])->get();
        return view("admin.admin-master-agent.view-master-agent", compact("users", "superagents"));
    }

    // ********** Agent *********

    public function manageAgent($agentId = null)
    {
        $query = User::with('roles')->where("role", 4);

        if ($agentId) {
            $query->where('sub_agent_id', $agentId);
        }
        $allagents = $query->get();

        return view('admin.admin-agent.manage-agent', compact('allagents'));
    }

    public function AddAgent()
    {
        $masteragents = User::with('roles')->whereIn("role", [3])->get();
        return view("admin.admin-agent.add-agent", compact('masteragents'));
    }

    public function postAgent(Request $request)
    {
        $request->validate([
            'sub_agent_id' => 'required',
            'first_name' => 'required',
            'tele_id' => 'required|unique:users,telegram_id',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email',
            'win_commission' => 'required',
            'loss_commission' => 'required',
        ]);

        $user = new User();
        $user->sub_agent_id = $request->sub_agent_id;
        $user->role = 4;
        $user->name = $request->first_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->telegram_id = $request->tele_id;
        $user->group_tele_id = $request->group_tele_id;
        $user->win_commission = $request->win_commission;
        $user->loss_commission = $request->loss_commission;

        $res = $user->save();

        if ($res) {
            return redirect()->route("manageAgent")->with("success", "Agent has been added successfully.");
        } else {
            return redirect()->route("manageAgent")->with("error", "Failed to add Agent.");
        }
    }


    public function editAgent($id)
    {
        $users = User::find($id);
        $masteragents = User::with('roles')->whereIn("role", [3])->get();
        return view("admin.admin-agent.edit-agent", compact("users", "masteragents"));
    }

    public function updateAgent(Request $request, $id)
    {
        $request->validate([
            'sub_agent_id' => 'required',
            'first_name' => 'required',
            'tele_id' => 'required|unique:users,telegram_id,' . $id,
            //'password' => 'required|min:8',
            'email' => 'required|email|unique:users,email,' . $id,
            'win_commission' => 'required',
            'loss_commission' => 'required',


        ]);

        $userfind = User::find($id);

        if (empty($userfind)) {
            return back()->with("failed", "Data not found");
        } else {

            if ($request->password) {
                $pass = Hash::make($request->password);
            } else {
                $pass = $userfind->password;
            }
            $userfind->sub_agent_id = $request->sub_agent_id;
            $userfind->name = $request->first_name;
            $userfind->email = $request->email;
            $userfind->telegram_id = $request->tele_id;
            $userfind->group_tele_id = $request->group_tele_id;
            $userfind->win_commission = $request->win_commission;
            $userfind->loss_commission = $request->loss_commission;
            $userfind->password = $pass;
            $userfind->role = 4;
            $userfind->save();

            return redirect()
                ->route("manageAgent")
                ->with("success", "Agent has been updated successfully.");
        }
    }

    public function deleteAgent($id)
    {
        $agent_id = $id;
        // // dd($user_id);
        $deleteUser = User::find($agent_id);
        $res = $deleteUser->delete();
        if ($res == true) {
            return back()->with("success", "Agent has been deleted successfully.");
        } else {
            return back()->with("failed", "Data not deleted.");
        }
    }

    public function viewAgent($id)
    {
        $users = User::find($id);
        $masteragents = User::with('roles')->whereIn("role", [3])->get();
        return view("admin.admin-agent.view-agent", compact("users", "masteragents"));
    }


    //Players list
    public function managePlayers()
    {
        $players = Player::get();
        //$agents =  User::with('roles')->where("role", 4);
        return view('admin.admin-player.manage-players', compact('players'));
    }

    //Show add  player form
    public function addPlayers()
    {
        $agents = User::with('roles')->whereIn("role", [4])->get();
        return view("admin.admin-player.add-players", compact('agents'));
    }

    // Add player data
    public function postaddPlayer(Request $request)
    {
        $request->validate([
            'password' => "required|min:8",
            'username' => 'required|unique:players,username' // Ensure tele_id is unique in the users table

        ]);

        $user = new Player();
        $user->username       = $request->username;
        $user->password       = Hash::make($request->password);
        $user->url            = $request->url;
        $user->ip             = $request->ip;
        $user->credits        = $request->credits;
        $user->max_win        = $request->max_win;
        $user->max_bet        = $request->max_bet;
        $user->agent_id       = $request->agent;
        $user->account_status = $request->account_status;
        $res = $user->save();


        return redirect()
            ->route("managePlayers")
            ->with("success", "Players has been added successfully.");
    }

    // Show Player Edit Form
    public function editviewPlayer($id)
    {
        $player = Player::find($id);
        $agents = User::with('roles')->whereIn("role", [4])->get();
        return view("admin.admin-player.edit-player", compact("player", 'agents'));
    }

    //update  player  data
    public function UpdatePlayer(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:players,username,' . $id,
        ]);

        $playerfind = Player::find($id);

        if (empty($playerfind)) {
            return back()->with("failed", "Data not found");
        } else {
            if ($request->password) {
                $pass = Hash::make($request->password);
            } else {
                $pass = $playerfind->password;
            }

            $playerfind->username       = $request->username;
            $playerfind->password       = Hash::make($request->password);
            $playerfind->url            = $request->url;
            $playerfind->ip             = $request->ip;
            $playerfind->credits        = $request->credits;
            $playerfind->max_win        = $request->max_win;
            $playerfind->max_bet        = $request->max_bet;
            $playerfind->agent_id       = $request->agent;
            $playerfind->account_status = $request->account_status;
            $playerfind->save();

            return redirect()
                ->route("managePlayers")
                ->with("success", "Players has been updated successfully.");
        }
    }


    // Delete Player
    public function DeletePlayer($id)
    {
        $player_id = $id;
        // // dd($user_id);
        $deletePlayer = Player::find($player_id);
        $res = $deletePlayer->delete();
        if ($res == true) {
            return back()->with("success", "Players has been deleted successfully.");
        } else {
            return back()->with("failed", "Data not deleted.");
        }
    }


    // View Player
    public function ViewPlayer($id)
    {
        $player = Player::find($id);
        $agents = User::with('roles')->whereIn("role", [2, 3, 4])->get();
        return view("admin.admin-player.view-player", compact("player", 'agents'));
    }

    public function manageRole()
    {
        $users = User::where('role', '!=', 1)->get();
        $roles = Role::all();
        return view('admin.manage-role', compact(['users', 'roles']));
    }

    public function updateRole(Request $request)
    {
        User::where('id', $request->user_id)->update([
            'role' => $request->role_id
        ]);
        return redirect()->back();
    }
}
