<?php

namespace App\Console\Commands;

use App\Answer;
use App\Question;
use Illuminate\Console\Command;

class deleteQuestion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:question';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->addArgument('start_id');
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $i = $this->argument('start_id') ?? 1;
        for($i; $i <= 15000; $i++){
            $question = Question::find($i);
            if(!$question){
                Answer::where("question_id",$i)->delete();
                $this->info("deleted:".$i.'----question not exists');
            }
            if($question && $question->answer_count < 4){
                $question->delete();
                Answer::where("question_id",$i)->delete();
                $this->info("deleted:".$i.'----answer_count:'.$question->answer_count);
            }
        }
    }
}
