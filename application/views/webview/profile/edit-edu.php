   <form id="form" action="<?=base_url()?>profile/add_education" method="post" name="education">
                        

                        <div class="margin-top"></div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>School</span><br /> <input type="text" class="form-control" name="school" placeholder="School" />
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>Dates Attended</span>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-2">
                                        <select name="year3" class="form-control">
                                                <option value="">--Year--</option>
                                                <?php for($i='1980'; $i<=2030; $i++){?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php } ?>
                                        </select>
                                </div>
                                <div class="col-md-1">-</div>
                                <div class="col-md-2">
                                        <select name="year4" class="form-control">
                                                <option value="">--Year--</option>
                                                <?php for($i='1980'; $i<=2030; $i++){?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php } ?>
                                        </select>
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>Degree</span><br /> <input type="text" class="form-control" name="degree" placeholder="Degree" />
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>Field of Study</span><br /> <input type="text" name="field_of_study" class="form-control" placeholder="Field of Study" />
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>Grade</span><br /> <input type="text" class="form-control" name="grade" placeholder="Grade" />
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>Activities and Socities</span><br />
                                        <textarea name="activities" rows="6" cols="" class="form-control"></textarea>
                                        <br /> Examples : Alpha Phi Omega, Chember Chorai, Debate Team
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span>Description</span><br />
                                        <textarea name="description" rows="6" cols="" class="form-control"></textarea>
                                </div>
                        </div>

                        <div class="row">
                                <div class="col-md-9">
                                        <span><a href="">See Examples</a></span>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-md-9">
                                        <input id="next" class="btn btn-primary form-btn" type="submit" value="Save"> 
                                        <input id="next" class="btn btn-primary form-btn" type="submit" value="Cancel">
                                </div>
                        </div>
                </form>