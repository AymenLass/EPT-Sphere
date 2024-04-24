<div id="{{ 'Science' . $item->id . 'modal' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" class="modal fade text-left" data-backdrop="static" data-keyboard="false">
    <div role="document" class="modal-dialog  modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{ $item->name }}
                    <small>({{ 'ID: ' . $item->st_id }})</small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="d-flex justify-content-center mx-1 mx-sm-3 mb-0 mt-2 pb-0 border-0">
                <div class="tabs mx-3 active" id="{{ 'mt_sc' . $item->id }}">
                    <h6 class="font-weight-bold">Model Test</h6>
                </div>
                <div class="tabs mx-3" id="{{ 'hy_sc' . $item->id }}">
                    <h6 class="text-muted">Half Yearly</h6>
                </div>
                <div class="tabs mx-3" id="{{ 'fnl_sc' . $item->id }}">
                    <h6 class="text-muted">Final</h6>
                </div>
            </div>
            <div class="line"></div>

            <div class="modal-body">
                <fieldset class="show" id="{{ 'mt_sc' . $item->id . '1' }}">

                    <form
                        action="{{ route('admin.students.exam.mt.update', ['class' => $item->c_class, 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col">
                                <label for="">French I</label>
                                <input type="text" name="french1" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->french1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">French II</label>
                                <input type="text" name="french2" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->french2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">English I</label>
                                <input type="text" name="english1" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->english1 }} @endif">
                            </div>
                            <div class="form-group
                                    col">
                                <label for="">English II</label>
                                <input type="text" name="english2" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->english2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">ICT</label>
                                <input type="text" name="ict" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->ict }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Physics I</label>
                                <input type="text" name="physics1" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->physics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Physics II</label>
                                <input type="text" name="physics2" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->physics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Electrnics I</label>
                                <input type="text" name="Electrnics1" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->Electrnics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Electrnics II</label>
                                <input type="text" name="Electrnics2" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->Electrnics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Mechanics I</label>
                                <input type="text" name="Mechanics1" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->Mechanics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Mechanics II</label>
                                <input type="text" name="Mechanics2" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->Mechanics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Higher Math I</label>
                                <input type="text" name="h_math1" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->h_math1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Higher Math II</label>
                                <input type="text" name="h_math2" class="form-control"
                                    value="@if ($mt_mark != null) {{ $mt_mark->h_math2 }} @endif">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="fas fa-check-circle"></i>
                                Update Model Test Marks</button>
                        </div>
                    </form>
                </fieldset>

                <fieldset id="{{ 'hy_sc' . $item->id . '1' }}">

                    <form
                        action="{{ route('admin.students.exam.hy.update', ['class' => $item->c_class, 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col">
                                <label for="">French I</label>
                                <input type="text" name="french1" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->french1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">French II</label>
                                <input type="text" name="french2" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->french2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">English I</label>
                                <input type="text" name="english1" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->english1 }} @endif">
                            </div>
                            <div class="form-group
                                    col">
                                <label for="">English II</label>
                                <input type="text" name="english2" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->english2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">ICT</label>
                                <input type="text" name="ict" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->ict }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Physics I</label>
                                <input type="text" name="physics1" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->physics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Physics II</label>
                                <input type="text" name="physics2" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->physics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Electrnics I</label>
                                <input type="text" name="Electrnics1" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->Electrnics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Electrnics II</label>
                                <input type="text" name="Electrnics2" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->Electrnics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Mechanics I</label>
                                <input type="text" name="Mechanics1" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->Mechanics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Mechanics II</label>
                                <input type="text" name="Mechanics2" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->Mechanics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Higher Math I</label>
                                <input type="text" name="h_math1" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->h_math1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Higher Math II</label>
                                <input type="text" name="h_math2" class="form-control"
                                    value="@if ($hy_mark != null) {{ $hy_mark->h_math2 }} @endif">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="fas fa-check-circle"></i>
                                Update Half Yearly Marks</button>
                        </div>
                    </form>
                </fieldset>

                <fieldset id="{{ 'fnl_sc' . $item->id . '1' }}">

                    <form
                        action="{{ route('admin.students.exam.fnl.update', ['class' => $item->c_class, 'id' => $item->id]) }}"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col">
                                <label for="">French I</label>
                                <input type="text" name="french1" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->french1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">French II</label>
                                <input type="text" name="french2" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->french2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">English I</label>
                                <input type="text" name="english1" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->english1 }} @endif">
                            </div>
                            <div class="form-group
                                    col">
                                <label for="">English II</label>
                                <input type="text" name="english2" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->english2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">ICT</label>
                                <input type="text" name="ict" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->ict }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Physics I</label>
                                <input type="text" name="physics1" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->physics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Physics II</label>
                                <input type="text" name="physics2" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->physics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Electrnics I</label>
                                <input type="text" name="Electrnics1" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->Electrnics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Electrnics II</label>
                                <input type="text" name="Electrnics2" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->Electrnics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Mechanics I</label>
                                <input type="text" name="Mechanics1" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->Mechanics1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Mechanics II</label>
                                <input type="text" name="Mechanics2" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->Mechanics2 }} @endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col">
                                <label for="">Higher Math I</label>
                                <input type="text" name="h_math1" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->h_math1 }} @endif">
                            </div>
                            <div class="form-group col">
                                <label for="">Higher Math II</label>
                                <input type="text" name="h_math2" class="form-control"
                                    value="@if ($fnl_mark != null) {{ $fnl_mark->h_math2 }} @endif">
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary btn-block"><i
                                    class="fas fa-check-circle"></i>
                                Update Final Exam Marks</button>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</div>
