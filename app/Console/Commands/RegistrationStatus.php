<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UsersApp;
use Mail;

class RegistrationStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:RegistrationStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ejecutar a las 8am para actualizar el tiempo del estado de registro';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        date_default_timezone_set('GMT');
        $fecha_actual = date("Y-m-d h:i:s");
        $fecha2antes  = date("Y-m-d h:i:s",strtotime($fecha_actual."- 2 days"));
        $fecha3antes  = date("Y-m-d h:i:s",strtotime($fecha_actual."- 3 days"));

        $registros = UsersApp::where('created_at','<',$fecha2antes)->where('created_at','>',$fecha3antes)->where('id_status_users_app','=',1)->get();

        if($registros){
          foreach ($registros as $value)
          {

            $a = array('name'=>$value->nombres, 'fecha' => $value->created_at);
            $s = 'batto.winhold@gmail.com';

            Mail::send('emails.remember_register',$a,function($message) use ($s)
            {
              $message->from('no-reply@winhold.net','WIN RIDESHARE');
              $message->to($s)->subject('AUN NO FINALIZASTE TU REGISTRO EN WIN');
            });

          }

        }

        $registrosdes = UsersApp::where('created_at','<',$fecha3antes)->where('id_status_users_app','=',1)->get();

        if($registrosdes){
          foreach ($registrosdes as $value)
          {
            $a = array('name'=>$value->nombres, 'fecha' => $value->created_at);
            $s = 'batto.winhold@gmail.com';

            Mail::send('emails.deshabilitado_user',$a,function($message) use ($s)
            {
              $message->from('no-reply@winhold.net','WIN RIDESHARE');
              $message->to($s)->subject('OFICINA VIRTUAL INHABILITADO');
            });

            $registross = UsersApp::where('id',$value->id)->first();
            $registross->id_status_users_app = 3;
            $registross->save();

          }
        }

    }
}
