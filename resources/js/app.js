import * as bootstrap from 'bootstrap';

import Alpine from 'alpinejs';

import './rh/expediente';
import './rh/empleados';
import './rh/incidencias';
import './rh/firma-uniforme';

import './operaciones/dobletes';
import './operaciones/supervisiones';
import './operaciones/incidencias';
import './facturas';
import './prenominas';
import './repse';

window.bootstrap = bootstrap;

window.Alpine = Alpine;

Alpine.start();