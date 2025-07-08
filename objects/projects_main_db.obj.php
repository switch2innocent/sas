<?php

class ProjectsMainDB
{

    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function get_projects()
    {
        $sql = "SELECT id, proj_name FROM projects WHERE status=1";
        $get_project = $this->conn->prepare($sql);

        $get_project->execute();
        return $get_project;
    }

    public function get_projects_ids()
    {
        $sql = "SELECT proj_name FROM projects WHERE id=? AND status=1";
        $get_projects_id = $this->conn->prepare($sql);

        $get_projects_id->bindParam(1, $this->proj_id);

        $get_projects_id->execute();
        return $get_projects_id;
    }
}
