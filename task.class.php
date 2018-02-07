<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;
    public function __construct($Id = null) {
        $this->TaskDataSource = file_get_contents('Task_Data.txt');
        if (strlen($this->TaskDataSource) > 0)
            $this->TaskDataSource = json_decode($this->TaskDataSource, true); // Should decode to an array of Task objects
        else
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array

        if (!$this->TaskDataSource)
            $this->TaskDataSource = array(); // If it does not, then the data source is assumed to be empty and we create an empty array
        if (!$this->LoadFromId($Id))
            $this->Create();
    }
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId();
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';
    }
    protected function getUniqueId() {
        // Assignment: Code to get new unique ID
        $id = end($this->TaskDataSource )['TaskId'];
        $id += 1;
        return $id; // Placeholder return for now
    }
    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
            foreach($this->TaskDataSource as $key => $task){
                if ($task["TaskId"] == $Id){
                    $this->TaskId = $Id;
                    $this->TaskName = $task['TaskName'];
                    $this->TaskDescription = $task['TaskDescription'];
                }
            }
            return true;
        } else
            return null;
    }

    public function Save($name, $description, $id) {
        //Assignment: Code to save task here]
        if ($id == -1){
            $task = array("TaskId" => $this->TaskId,"TaskName" => $name, "TaskDescription" => $description);
            array_push($this->TaskDataSource, $task);
        }else{
            foreach($this->TaskDataSource as $key => $task){
                if ($task["TaskId"] == $id){
                    $this->TaskDataSource[$key]["TaskName"] = $name;
                    $this->TaskDataSource[$key]["TaskDescription"] = $description;
                }
            }
        }
        $jsonTasks = json_encode($this->TaskDataSource);
        file_put_contents('Task_Data.txt', $jsonTasks);
    }
    public function Delete() {
        //Assignment: Code to delete task here
        echo $this->TaskId;
        foreach($this->TaskDataSource as $key => $task){
            if ($task["TaskId"] == $this->TaskId){
                unset($this->TaskDataSource[$key]);
            }
            
        }
        $jsonTasks = json_encode($this->TaskDataSource);
        
        file_put_contents('Task_Data.txt', $jsonTasks);
    }
}
?>