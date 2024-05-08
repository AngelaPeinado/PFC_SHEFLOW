@extends('layouts.app')

@section('content')
    <br><br><br><br><br><br>
    <div class="container align-items-center d-flex justify-content-center" style="min-height: 70vh;">
        <form action="{{ route('form.store') }}" method="POST" id="cuestionarioForm" >
            @csrf
            <!--PREGUNTA 1-->
            <div class="pregunta" id="pregunta1">
                <h2>¿Cuál es la finalidad por la que usas la aplicación?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowHeart.png" alt="Opción 1" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Seguir mi ciclo y ver los impactos sobre mi salud
                                        <input class="form-check-input" type="radio" name="respuesta_p1" id="respuesta_p1_1" value="Seguir mi ciclo y ver los impactos sobre mi salud">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowLifting.png" alt="Opción 2" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Practico powerlifting y estoy interesada en conocer la relación entre ambos temas
                                        <input class="form-check-input" type="radio" name="respuesta_p1" id="respuesta_p1_2" value="Practico powerlifting y estoy interesada en conocer la relación entre ambos temas">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowMedal.png" alt="Opción 3" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Soy competidora y me gustaría sacar información sobre mi ciclo para mejorar mi rendimiento
                                        <input class="form-check-input" type="radio" name="respuesta_p1" id="respuesta_p1_3" value="Soy competidora y me gustaría sacar información sobre mi ciclo para mejorar mi rendimiento">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowHeart2.png" alt="Opción 4" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Otros
                                        <input class="form-check-input" type="radio" name="respuesta_p1" id="respuesta_p1_4" value="Otros">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 2-->
            <div class="pregunta" id="pregunta2" style="display: none;">
                <h2>¿Sueles rastrear tu ciclo?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowCalendar.png" alt="Opción 1" width="110px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Si
                                        <input class="form-check-input" type="radio" name="respuesta_p2" id="respuesta_p2_si" value="Si">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowCalendarNO.png" alt="Opción 2" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No
                                        <input class="form-check-input" type="radio" name="respuesta_p2" id="respuesta_p2_no" value="No">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 3-->
            <div class="pregunta" id="pregunta3" style="display: none;">
                <h2>¿Tu periodo es regular?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowRegular.png" alt="Opción 1" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Si
                                        <input class="form-check-input" type="radio" name="respuesta_p3" id="respuesta_p3_si" value="Si">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowIrregular.png" alt="Opción 2" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No
                                        <input class="form-check-input" type="radio" name="respuesta_p3" id="respuesta_p3_no" value="No">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowQuestion.png" alt="Opción 3" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No estoy segura
                                        <input class="form-check-input" type="radio" name="respuesta_p3" id="respuesta_p3_no_segura" value="No estoy segura">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--PREGUNTA 4-->
            <div class="pregunta" id="pregunta4" style="display: none;">
                <h2>¿Cuándo te sientes mejor?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowPeriod.png" alt="Opción 1" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Con la regla
                                        <input class="form-check-input" type="radio" name="respuesta_p4" id="respuesta_p4_con_la_regla" value="Con la regla">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowOvulando.png" alt="Opción 2" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Ovulando
                                        <input class="form-check-input" type="radio"  name="respuesta_p4" id="respuesta_p4_ovulando" value="Ovulando">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowPremenstrual.png" alt="Opción 3" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Premenstrual
                                        <input class="form-check-input" type="radio" name="respuesta_p4" id="respuesta_p4_premenstrual" value="Premenstrual">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowPreovulando.png" alt="Opción 3" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Preovulando
                                        <input class="form-check-input" type="radio" name="respuesta_p4" id="respuesta_p4_preovulando" value="Preovulando">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowQuestion.png" alt="Opción 3" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No tengo ni idea de las fases de mi ciclo
                                        <input class="form-check-input" type="radio" name="respuesta_p4" id="respuesta_p4_no_tengo_ni_idea" value="No tengo ni idea de las fases de mi ciclo">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 5-->
            <div class="pregunta" id="pregunta5" style="display: none;">
                <h2>¿Has tenido algún embarazo?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowPregnant.png" alt="Opción 1" width="150px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Si
                                        <input class="form-check-input" type="radio" name="respuesta_p5" id="respuesta_p5_si" value="Si">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowPregnantNO.png" alt="Opción 2" width="150px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No
                                        <input class="form-check-input" type="radio" name="respuesta_p5" id="respuesta_p5_no" value="No">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 6-->
            <div class="pregunta" id="pregunta6" style="display: none;">
                <h2>¿Sufres dolor antes o durante el periodo?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowPain.png" alt="Opción 1" width="110px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Sí, mucho
                                        <input class="form-check-input" type="radio" name="respuesta_p6" id="respuesta_p6_si_mucho" value="Si, mucho">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowMediumPain.png" alt="Opción 2" width="150px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        De vez en cuando
                                        <input class="form-check-input" type="radio"  name="respuesta_p6" id="respuesta_p6_de_vez_en_cuando" value="De vez en cuando">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowNoPain.png" alt="Opción 3" width="150px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No, nunca
                                        <input class="form-check-input" type="radio" name="respuesta_p6" id="respuesta_p6_no_nunca" value="No, nunca">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 7-->
            <div class="pregunta" id="pregunta7" style="display: none;">
                <h2>¿Sufres alguna enfermedad de salud reproductiva?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowWomanIll.png" alt="Opción 1" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Si
                                        <input class="form-check-input" type="radio" name="respuesta_p7" id="respuesta_p7_si" value="Si">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowWomanNoIll.png" alt="Opción 2" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No
                                        <input class="form-check-input" type="radio" name="respuesta_p7" id="respuesta_p7_no" value="No">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 8-->
            <div class="pregunta" id="pregunta8" style="display: none;">
                <h2>¿Tienes cólicos antes del periodo?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowColicos.png" alt="Opción 1" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Si
                                        <input class="form-check-input" type="radio" name="respuesta_p8" id="respuesta_p8_si" value="Si">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowNoColicos.png" alt="Opción 2" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No
                                        <input class="form-check-input" type="radio" name="respuesta_p8" id="respuesta_p8_no" value="No">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 9-->
            <div class="pregunta" id="pregunta9" style="display: none;">
                <h2>¿Usas anticonceptivos hormonales?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="https://www.svgrepo.com/show/194886/pills-pill.svg" alt="Opción 1" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Sí, los uso
                                        <input class="form-check-input" type="radio" name="respuesta_p9" id="respuesta_p9_si_los_uso" value="Sí, los uso">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="https://cdn-icons-png.flaticon.com/256/5898/5898090.png" alt="Opción 2" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No uso anticonceptivos
                                        <input class="form-check-input" type="radio"  name="respuesta_p9" id="respuesta_p9_no_uso_anticonceptivos" value="No uso anticonceptivos">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="https://cdn-icons-png.flaticon.com/512/3309/3309031.png" alt="Opción 3" width="60px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Sí uso, pero no hormonales
                                        <input class="form-check-input" type="radio" name="respuesta_p9" id="respuesta_p9_si_uso_pero_no_hormonales" value="Sí uso, pero no hormonales">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowQuestion.png" alt="Opción 4" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No se que son anticonceptivos hormonales
                                        <input class="form-check-input" type="radio" name="respuesta_p9" id="respuesta_p9_no_se_que_son_hormonales" value="No se que son anticonceptivos hormonales">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 10-->
            <div class="pregunta" id="pregunta10" style="display: none;">
                <h2>¿Experimentas sangrado intermenstrual?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowSagradoIntermestrual.png" alt="Opción 1" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Sí
                                        <input class="form-check-input" type="radio" name="respuesta_p10" id="respuesta_p10_si" value="Sí">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowNoSangrado.png" alt="Opción 2" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No
                                        <input class="form-check-input" type="radio"  name="respuesta_p10" id="respuesta_p10_no" value="No">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowQuestion.png" alt="Opción 3" width="120px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No se que es eso
                                        <input class="form-check-input" type="radio" name="respuesta_p10" id="respuesta_p10_no_se_que_es" value="No se que es eso">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--PREGUNTA 11-->
            <div class="pregunta" id="pregunta11" style="display: none;">
                <h2>¿Duermes bien?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowSleepGood.png" alt="Opción 1" width="110px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Sí, siempre
                                        <input class="form-check-input" type="radio" name="respuesta_p11" id="respuesta_p11_si_siempre" value="Si, siempre">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowSleepDepends.png" alt="Opción 2" width="110px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        Depende del día
                                        <input class="form-check-input" type="radio"  name="respuesta_p11" id="respuesta_p11_depende_del_dia" value="Depende del día">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body align-items-center">
                                <img src="SheFlowSleepBad.png" alt="Opción 3" width="110px" class="mr-3">
                                <br/>
                                <div>
                                    <label class="form-check-label d-block">
                                        No, nunca
                                        <input class="form-check-input" type="radio" name="respuesta_p11" id="respuesta_p11_no_nunca" value="No, nunca">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button type="button" class="btn btn-outline-secondary rounded-pill" onclick="mostrarPregunta(Math.max(1, preguntaActual - 1))" id="anteriorBtn" style="display: none;">Anterior</button>
                <button type="button" class="btn btn-outline-dark rounded-pill" onclick="mostrarPregunta(preguntaActual + 1)" id="siguienteBtn">Siguiente</button>
                <button type="submit" class="cta" id="guardarBtn" style="display: none;"> <!-- Botón para iniciar el cuestionario -->
                    <span>{{ __('Guardar') }}</span>
                    <svg width="13px" height="10px" viewBox="0 0 13 10">
                        <path d="M1,5 L11,5"></path>
                        <polyline points="8 1 12 5 8 9"></polyline>
                    </svg>
                </button>
            </div>
        </form>
    </div>


    <script>
        let preguntaActual = 1;

        function mostrarPregunta(numeroPregunta) {
            document.getElementById('pregunta' + preguntaActual).style.display = 'none';
            document.getElementById('pregunta' + numeroPregunta).style.display = 'block';

            if (numeroPregunta === 1) {
                document.getElementById('anteriorBtn').style.display = 'none';
            } else {
                document.getElementById('anteriorBtn').style.display = 'block';
            }

            if (numeroPregunta === 11) {
                document.getElementById('siguienteBtn').style.display = 'none';
                document.getElementById('guardarBtn').style.display = 'block';
            } else {
                document.getElementById('siguienteBtn').style.display = 'block';
                document.getElementById('guardarBtn').style.display = 'none';
            }

            preguntaActual = numeroPregunta;
        }
    </script>
@endsection
