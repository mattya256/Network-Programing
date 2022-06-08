<?php

namespace App\Http\Controllers;

use mysqli;
use PDO;
use DB;
use Log;
use Illuminate\Http\Request;

class SQLController extends Controller
{
    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "cs18075";
        $this->password = "MFITmfit69";
        $this->dbname = "mydb";
    }

    // MySQLi: SQL Injection
    public function injectionMySQLi()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            abort(301, "database connection failed.");
        }

        $sql = "SELECT id FROM np_user WHERE id = '$loginUser' AND password = '$loginPassword';";
        $results = $conn->query($sql);

        $message = "Login Failed!!";
        if ($results->num_rows > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => $sql]);
    }

    // MySQLi: No SQL Injection
    public function noInjectionMySQLi()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            abort(301, "database connection failed.");
        }

        $sql = "SELECT id FROM np_user WHERE id = ? AND password = ?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $loginUser, $loginPassword);
        $stmt->execute();
        $results = $stmt->get_result();

        $message = "Login Failed!!";
        if ($results->num_rows > 0) {
            $message = "Login Success!!";
        }
        // MySQLi does not have api to get complete query after binding parameters
        return view('sql/injection_result', ['message' => $message, 'query' => $sql]);
    }

    // PDO: SQL Injection
    public function injectionPDO()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $pdo = null;
        try {
            $dsn = "mysql:dbname=" . $this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            abort(301, "database connection failed." . $e->getMessage());
        }

        $sql = "SELECT id FROM np_user WHERE id = '$loginUser' AND password = '$loginPassword';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $message = "Login Failed!!";
        if ($stmt->rowCount() > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => $stmt->queryString]);
    }

    // PDO: No SQL Injection
    public function noInjectionPDO()
    {
        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $pdo = null;
        try {
            $dsn = "mysql:dbname=" . $this->dbname . ";host=" . $this->servername;
            $pdo = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            abort(301, "database connection failed." . $e->getMessage());
        }

        $sql = "SELECT id FROM np_user WHERE id = :loginUser AND password = :loginPassword;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':loginUser', $loginUser);
        $stmt->bindParam(':loginPassword', $loginPassword);
        $stmt->execute();

        $message = "Login Failed!!";
        if ($stmt->rowCount() > 0) {
            $message = "Login Success!!";
        }
        // PDO does not have api to get complete query after binding parameters
        return view('sql/injection_result', ['message' => $message, 'query' => $stmt->queryString]);
    }

    // Laravel Query Builder: SQL Injection
    public function injectionLaravelQueryBuilder()
    {
        // Debug for SQL Statements
        DB::enableQueryLog();

        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $whereSql = "id = '$loginUser' and password = '$loginPassword'";
        $results = DB::table("np_user")
            ->selectRaw("id")
            ->whereRaw($whereSql)
            ->get();

        // Debug with Log Facade -> storage/logs/laravel.log
        Log::debug(DB::getQueryLog());

        $message = "Login Failed!!";
        if (count($results) > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => json_encode(DB::getQueryLog())]);
    }

    // Laravel Query Builder: No SQL Injection
    public function noInjectionLaravelQueryBuilder()
    {
        // Debug for SQL Statements
        DB::enableQueryLog();

        $loginUser = request('user');
        $loginPassword = request('password');
        if (!isset($loginUser) || !isset($loginPassword)) {
            abort(301, "user or password not set.");
        }

        $results = DB::table("np_user")
            ->select("id")
            ->where('id', '=', ':loginUser')
            ->where('password', '=', 'loginPassword')
            ->setBindings(['loginUser' => $loginUser, 'loginPassword' => $loginPassword])
            ->get();

        // Debug with Log Facade -> storage/logs/laravel.log
        Log::debug(DB::getQueryLog());

        $message = "Login Failed!!";
        if (count($results) > 0) {
            $message = "Login Success!!";
        }
        return view('sql/injection_result', ['message' => $message, 'query' => json_encode(DB::getQueryLog())]);
    }

    public function searchWinResults()
    {
        //
        // modify following code for searching win matches
        //
        $team_id = request('team');

        // sample query: search all tournament name
        $results = DB::table("wc_tournament")
            ->join('wc_round', 'wc_tournament.id', '=', 'wc_round.tournament_id')
            ->join('wc_match', 'wc_match.round_id', '=', 'wc_round.id')
            ->join('wc_group', 'wc_match.group_id', '=', 'wc_group.id')
            ->join('wc_result', 'wc_result.match_id', '=', 'wc_match.id')
            ->join('wc_team as t0', 't0.id', '=', 'wc_result.team_id0')
            ->join('wc_team as t1', 't1.id', '=', 'wc_result.team_id1')
            ->select(
            'wc_round.name AS round_name',
            'wc_tournament.name AS tournament_name',
            'wc_group.name AS group_name',
            'wc_match.ordering AS DATE',
            'wc_result.outcome AS result_outcome',
            't0.name AS team0_name',
            't1.name AS team1_name')   
            ->whereraw("(t0.id='".$team_id."' AND wc_result.outcome like '勝利')
            OR (t1.id='".$team_id."' AND wc_result.outcome like '敗北')")
            ->get();
          

        // show page based on the template: sql/search_win_matchers.blade.php with parameters: team, data
        return view('sql/search_win_results', [
            'team' => $team_id,
            'data' => $results
        ]);
    }
}
