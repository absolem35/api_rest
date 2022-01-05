<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Empleados extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Empleado_model");
        // $this->methods['empleado_get']['limit'] = 500; // 500 requests per hour per user/key
        // $this->methods['empleado_post']['limit'] = 100; // 100 requests per hour per user/key
        // $this->methods['empleado_delete']['limit'] = 50; // 50 requests per hour per user/key
        // $this->methods['empleado_put']['limit'] = 50; // 50 requests per hour per user/key

    }

    //saca todos los usuarios en json

    public function empleado_get($id = null)
    {

        // $id = $this->get('id');

        $users = $this->Empleado_model->getEmpleado($id);

        if (!is_null($users)) {
            $this->response(array('data' => $users), 200);
        } else {
            $this->response(NULL);
        }
    }

    public function empleado_post()
    {

        $fecha_ingreso = $this->post('fecha_ingreso');
        $nombre = $this->post('nombre');
        $salario = $this->post('salario');

        $result = $this->Empleado_model->insertEmpleado($fecha_ingreso, $nombre, $salario);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'), 404);
        } else {
            $this->response(array('status' => 'success'), 201);
        }
    }

    public function empleado_update_post($id)
    {
        $fecha_ingreso = $this->post('fecha_ingreso');
        $nombre = $this->post('nombre');
        $salario = $this->post('salario');

        $result = $this->Empleado_model->setEmpleado($id, $nombre, $fecha_ingreso, $salario);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'), 404);
        } else {
            $this->response(array('status' => true, 'response' => 'ok'), 201);
        }
    }

    public function empleado_delete($id)
    {

        if (!empty($id)) {

            $result = $this->Empleado_model->deleteEmpleado($id);
            if ($result === FALSE) {
                $this->response(array('status' => 'failed'), 404);
            } else {
                $this->response(array('status' => 'no_content'), 204);
            }
        } else {
            $this->response(array(
                'status' => 'failed',
                'message' => 'Falta el parametro ID'
            ), 404);
        }
    }
}
