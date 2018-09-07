<?php
class onyx_model{
	private $db;
	private $data;
	public function __construct(){
		$this->db=Conectar::conexion();
		$this->data=array();
		//$this->datab=array();
	}

	public function get_data_fecha(){

		$consulta = pg_query($this->db, "SELECT fecha_insercion::date, COUNT(fecha_insercion) total
			FROM onyx.tickets_onyx
			WHERE EXTRACT(month FROM fecha_insercion) = 6
			GROUP BY fecha_insercion
			ORDER BY fecha_insercion ASC;");

		while ($datos = pg_fetch_assoc($consulta)){
			   $this->data[]=$datos;
		}
		//print_r($this->data); die();
		return $this->data;
	}

	public function get_data_prioridad(){

		$consultab = pg_query($this->db, "SELECT prioridad, COUNT(prioridad) as conteo
                            FROM onyx.tickets_onyx
                            WHERE to_char(fecha_insercion, 'TMMONTH') = 'MARZO' AND to_char(fecha_insercion, 'yyyy') = '2018'
                            GROUP BY prioridad
                            ORDER BY prioridad ASC");

		while ($datosb = pg_fetch_assoc($consultab)){
			   $this->datab[]=$datosb;
		}
		//print_r($this->data); die();
		return $this->datab;
	}

	public function get_data_top(){

		$consulta = pg_query($this->db, "SELECT cliente, COUNT(cliente) as conteo_cliente
											FROM onyx.tickets_onyx 
											WHERE (prioridad = '1 - Falla Crítica'  OR prioridad = '2 - Falla  Mayor')
											GROUP BY cliente
											ORDER BY conteo_cliente DESC
											LIMIT 10
							");

		while ($datos = pg_fetch_assoc($consulta)){
			   $this->data[]=$datos;
		}
		//print_r($this->data); die();
		return $this->data;
	}

	public function get_tickets_day(){

		$consulta = pg_query($this->db, "SELECT fecha_insercion as fecha, COUNT(fecha_insercion) as conteo
                                        FROM onyx.tickets_onyx
                                        WHERE  to_char(fecha_insercion, 'YYYY-MM-DD') = '".$fecha."'
                                        GROUP BY fecha
                                        ORDER BY fecha
							");

		while ($datos = pg_fetch_assoc($consulta)){
			   $this->data[]=$datos;
		}
		//print_r($this->data); die();
		return $this->data;
	}

	 public function get_tickets_prioridad(){
        $consulta=pg_query($this->db,"SELECT to_char(fecha_insercion,'YYYY-MM-DD') as fecha, COUNT(fecha_insercion) AS total_tickets, prioridad
                FROM onyx.tickets_onyx
                WHERE to_char(fecha_insercion, 'TMMONTH') = 'ENERO' AND to_char(fecha_insercion, 'yyyy') = '2018'
                GROUP BY prioridad, fecha
                ORDER BY fecha ASC
            ");
        $this->data=array();
        while($datos=pg_fetch_assoc($consulta)){
            $this->data[]=$datos;
        }
        return $this->data;
    }

}