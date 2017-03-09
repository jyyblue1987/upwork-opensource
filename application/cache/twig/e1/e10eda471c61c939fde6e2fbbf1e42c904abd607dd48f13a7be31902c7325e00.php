<?php

/* webview/jobs/twig/contract.twig */
class __TwigTemplate_0e3ffd94f0d78bb3b0fba7b33a695e079c4f7e74868d1817d610c6a54cd2aa42 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("webview/layout/twig/layout.twig", "webview/jobs/twig/contract.twig", 1);
        $this->blocks = array(
            'styles' => array($this, 'block_styles'),
            'content' => array($this, 'block_content'),
            'js' => array($this, 'block_js'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "webview/layout/twig/layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_styles($context, array $blocks = array())
    {
        // line 4
        echo "    ";
        $this->displayParentBlock("styles", $context, $blocks);
        echo "
    <link rel=\"stylesheet\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, base_url("assets/css/pages/contract.css"), "html", null, true);
        echo "\">
";
    }

    // line 8
    public function block_content($context, array $blocks = array())
    {
        // line 9
        echo "    
    ";
        // line 10
        $context["job_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()));
        // line 11
        echo "    ";
        $context["fuser_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()));
        // line 12
        echo "    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">";
        // line 19
        echo twig_escape_filter($this->env, sprintf(app_lang("text_job_since"), app_date($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "start_date", array()), " M j, Y ")), "html", null, true);
        echo "</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID ";
        // line 22
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "contact_id", array()), "html", null, true);
        echo " </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-5\">
                            <div class=\"row\">
                                <div style=\"margin-left: 20px;\" class=\"col-md-4 col-md-offset-1 text-left\">
                                    <div class=\"st_img hourly_client_view_st_img\">
                                        <img src=\"";
        // line 32
        echo twig_escape_filter($this->env, app_user_img($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_picture", array())), "html", null, true);
        echo "\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <h5 style=\"margin-top: -4px;\" class=\"free_name\">";
        // line 36
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "html", null, true);
        echo "</label>
                                        <br> <p class=\"free_name\">";
        // line 37
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_company", array()), "html", null, true);
        echo "</p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                ";
        // line 43
        if (($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "jobstatus", array()) == 1)) {
            // line 44
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_ended")), "html", null, true);
            echo "</label>
                                ";
        } else {
            // line 46
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_actived")), "html", null, true);
            echo "</label>
                                ";
        }
        // line 48
        echo "                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button\" 
                                       value=\"Message\" 
                                       onclick=\"loadmessage(";
        // line 54
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_id", array()), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()), "html", null, true);
        echo ")\" 
                                       />
                            </div>
                        </div>
                        
                        <div class=\"col-md-12\">
                            <div class=\"job_title client_job_title\">
                                <span class=\"clint_view_j-title\"> 
                                    ";
        // line 62
        if (twig_test_empty($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array()))) {
            // line 63
            echo "                                       ";
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array());
            // line 64
            echo "                                    ";
        } else {
            // line 65
            echo "                                        ";
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array());
            // line 66
            echo "                                    ";
        }
        // line 67
        echo "                                    ";
        echo twig_escape_filter($this->env, (isset($context["job_title"]) ? $context["job_title"] : null), "html", null, true);
        echo "</span><br />
                                <a href=\"";
        // line 68
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "jobs/view/";
        echo twig_escape_filter($this->env, url_title($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array())), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
        echo "\">View original job post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class=\"bg-change\"></div>
            
            <div class=\"row \">
                <div style=\"padding: 3px 10px 5px;border: 1px solid #ccc;border-top: 0;border-radius: 0 0 4px 4px;\" class=\"col-md-9 white-box remove-border-top \">
                    <div class=\"row\"></div>
                    
                    <div style=\"margin-left: 28px;\" class=\"row margin-top-2 bordered_week\">
                       <div class=\"col-md-10 col-md-offset-1\">
                           <div class=\"row\">
                               <div style=\"padding-top: 5px; margin-right: -6px;\" class=\"col-md-4 paid_table_title text-centered text-center\">
                                   <b>";
        // line 85
        echo twig_escape_filter($this->env, app_lang("text_job_contract_amount"), "html", null, true);
        echo "</b>
                               </div>
                               <div style=\"padding-top: 5px; border-left: 2px solid #ededed; margin-right: 10px;\" class=\"col-md-4 text-centered text-center\">
                                   <b>";
        // line 88
        echo twig_escape_filter($this->env, app_lang("text_job_contract_paid"), "html", null, true);
        echo "</b>
                               </div>
                               <div style=\"width: 76px; padding-top: 5px; margin-left: 0px; padding-left: 83px; border-left: 2px solid rgb(237, 237, 237);\" 
                                    class=\"col-md-4 text-centered text-center\">
                                   <b>";
        // line 92
        echo twig_escape_filter($this->env, app_lang("text_job_contract_remaining_amount"), "html", null, true);
        echo " </b>
                               </div>
                           </div>
                       </div>
                       <div class=\"row margin-top-1\">
                           <div class=\"col-md-10  col-md-offset-1\">
                               <div class=\"row nav-bar\">
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4 text-center nav-bar-item\">
                                       <span class=\"bold_text\">
                                           ";
        // line 101
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hired_on", array()), "html", null, true);
        echo "
                                       </span>
                                   </div>
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4 text-center nav-bar-item\">
                                       <span class=\"bold_text\">
                                           ";
        // line 106
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fixedpay_amount", array()), "html", null, true);
        echo "
                                       </span>
                                   </div>
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4  text-center nav-bar-item\">
                                       <span class=\"bold_text\">

                                           ";
        // line 112
        $context["remain_budget"] = ($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_amount", array()) - $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fixedpay_amount", array()));
        // line 113
        echo "
                                           ";
        // line 114
        if (((isset($context["remain_budget"]) ? $context["remain_budget"] : null) < 0)) {
            // line 115
            echo "                                               ";
            $context["remain_budget"] = 0;
            // line 116
            echo "                                           ";
        }
        // line 117
        echo "
                                           \$";
        // line 118
        echo twig_escape_filter($this->env, (isset($context["remain_budget"]) ? $context["remain_budget"] : null), "html", null, true);
        echo "
                                       </span>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                
                    <div class=\"row margin-top-1\"> </div>
                    
                    ";
        // line 129
        echo "                    
                    <div class=\"row margin-top-5 margin-bottom-2\">
                        <div class=\"col-md-10 col-md-offset-1\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"\">
                                        <input style=\"float: left;margin-left: 0;\" type=\"button\" class=\"btn my_btn btn-cancel\" value=\"Add Milestone\" id =\"2\" onclick=\"editClickedMilestone(this.id)\" />
                                    </div>
                                    <input style=\"margin-left: 15px;\" type=\"button\" class=\"btn my_btn btn-cancel\" value=\"Payment\"  id =\"2\" onclick=\"editClickedPayment(this.id)\" />
                                </div>
                                <div class=\"col-md-6\">
                                    <div style=\"float: left; position: absolute;right: 143px;\" class=\"cancel_content_btn\">
                                        <input value=\"Cancel\" class=\"btn my_btn btn-cancel\" type=\"button\"> 
                                    </div>
                                    <div class=\"\">
                                        ";
        // line 144
        if (($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "jobstatus", array()) == 1)) {
            // line 145
            echo "                                            <a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "feedback/fixed_client?fmJob=";
            echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
            echo "&fuser=";
            echo twig_escape_filter($this->env, (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null), "html", null, true);
            echo "\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"End Contract\" />
                                            </a>
                                        ";
        } else {
            // line 149
            echo "                                            <a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "endhourlyfixed/fixed_client?fmJob=";
            echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
            echo "&fuser=";
            echo twig_escape_filter($this->env, (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null), "html", null, true);
            echo "\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"End Contract\" />
                                            </a>
                                        ";
        }
        // line 153
        echo "                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
";
    }

    // line 164
    public function block_js($context, array $blocks = array())
    {
        // line 165
        echo "    ";
        $this->displayParentBlock("js", $context, $blocks);
        echo "
    ";
        // line 167
        echo "    <script src=\"";
        echo twig_escape_filter($this->env, app_modular_js("pages/contract.js"), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "webview/jobs/twig/contract.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  320 => 167,  315 => 165,  312 => 164,  299 => 153,  287 => 149,  275 => 145,  273 => 144,  256 => 129,  243 => 118,  240 => 117,  237 => 116,  234 => 115,  232 => 114,  229 => 113,  227 => 112,  218 => 106,  210 => 101,  198 => 92,  191 => 88,  185 => 85,  161 => 68,  156 => 67,  153 => 66,  150 => 65,  147 => 64,  144 => 63,  142 => 62,  127 => 54,  119 => 48,  113 => 46,  107 => 44,  105 => 43,  96 => 37,  90 => 36,  83 => 32,  70 => 22,  64 => 19,  55 => 12,  52 => 11,  50 => 10,  47 => 9,  44 => 8,  38 => 5,  33 => 4,  30 => 3,  11 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% extends \"webview/layout/twig/layout.twig\" %}

{% block styles %}
    {{ parent() }}
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/contract.css\") }}\">
{% endblock %}

{% block content %}
    
    {% set job_id_encoded   = base64_encode( job_status.job_id ) %}
    {% set fuser_id_encoded = base64_encode( job_status.fuser_id ) %}
    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">{{ app_lang('text_job_since')|format( app_date( job_status.start_date, ' M j, Y ') ) }}</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID {{ job_status.contact_id }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=\"row\">
                        <div class=\"col-md-5\">
                            <div class=\"row\">
                                <div style=\"margin-left: 20px;\" class=\"col-md-4 col-md-offset-1 text-left\">
                                    <div class=\"st_img hourly_client_view_st_img\">
                                        <img src=\"{{ app_user_img( job_status.webuser_picture ) }}\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <h5 style=\"margin-top: -4px;\" class=\"free_name\">{{ job_status.webuser_fname }} {{ job_status.webuser_lname }}</label>
                                        <br> <p class=\"free_name\">{{ job_status.webuser_company }}</p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                {% if job_status.jobstatus == 1 %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_ended')) }}</label>
                                {% else %}
                                    <label class=\"gray-text\">{{ app_lang('text_job_status_state')|format(app_lang('text_job_state_actived')) }}</label>
                                {% endif %}
                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button\" 
                                       value=\"Message\" 
                                       onclick=\"loadmessage({{ job_status.bid_id }}, {{ job_status.fuser_id }}, {{ job_status.job_id }})\" 
                                       />
                            </div>
                        </div>
                        
                        <div class=\"col-md-12\">
                            <div class=\"job_title client_job_title\">
                                <span class=\"clint_view_j-title\"> 
                                    {% if job_status.hire_title is empty %}
                                       {% set job_title = job_status.title %}
                                    {% else %}
                                        {% set job_title = job_status.hire_title %}
                                    {% endif  %}
                                    {{ job_title }}</span><br />
                                <a href=\"{{ base_url() }}jobs/view/{{ url_title( job_status.title ) }}/{{ job_id_encoded }}\">View original job post</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class=\"bg-change\"></div>
            
            <div class=\"row \">
                <div style=\"padding: 3px 10px 5px;border: 1px solid #ccc;border-top: 0;border-radius: 0 0 4px 4px;\" class=\"col-md-9 white-box remove-border-top \">
                    <div class=\"row\"></div>
                    
                    <div style=\"margin-left: 28px;\" class=\"row margin-top-2 bordered_week\">
                       <div class=\"col-md-10 col-md-offset-1\">
                           <div class=\"row\">
                               <div style=\"padding-top: 5px; margin-right: -6px;\" class=\"col-md-4 paid_table_title text-centered text-center\">
                                   <b>{{ app_lang('text_job_contract_amount') }}</b>
                               </div>
                               <div style=\"padding-top: 5px; border-left: 2px solid #ededed; margin-right: 10px;\" class=\"col-md-4 text-centered text-center\">
                                   <b>{{ app_lang('text_job_contract_paid') }}</b>
                               </div>
                               <div style=\"width: 76px; padding-top: 5px; margin-left: 0px; padding-left: 83px; border-left: 2px solid rgb(237, 237, 237);\" 
                                    class=\"col-md-4 text-centered text-center\">
                                   <b>{{ app_lang('text_job_contract_remaining_amount') }} </b>
                               </div>
                           </div>
                       </div>
                       <div class=\"row margin-top-1\">
                           <div class=\"col-md-10  col-md-offset-1\">
                               <div class=\"row nav-bar\">
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4 text-center nav-bar-item\">
                                       <span class=\"bold_text\">
                                           {{ job_status.hired_on }}
                                       </span>
                                   </div>
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4 text-center nav-bar-item\">
                                       <span class=\"bold_text\">
                                           {{ job_status.fixedpay_amount }}
                                       </span>
                                   </div>
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4  text-center nav-bar-item\">
                                       <span class=\"bold_text\">

                                           {% set remain_budget = job_status.bid_amount - job_status.fixedpay_amount %}

                                           {% if remain_budget < 0 %}
                                               {% set remain_budget = 0 %}
                                           {% endif  %}

                                           \${{ remain_budget }}
                                       </span>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
                
                    <div class=\"row margin-top-1\"> </div>
                    
                    {# Load transaction line here... #}
                    
                    <div class=\"row margin-top-5 margin-bottom-2\">
                        <div class=\"col-md-10 col-md-offset-1\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"\">
                                        <input style=\"float: left;margin-left: 0;\" type=\"button\" class=\"btn my_btn btn-cancel\" value=\"Add Milestone\" id =\"2\" onclick=\"editClickedMilestone(this.id)\" />
                                    </div>
                                    <input style=\"margin-left: 15px;\" type=\"button\" class=\"btn my_btn btn-cancel\" value=\"Payment\"  id =\"2\" onclick=\"editClickedPayment(this.id)\" />
                                </div>
                                <div class=\"col-md-6\">
                                    <div style=\"float: left; position: absolute;right: 143px;\" class=\"cancel_content_btn\">
                                        <input value=\"Cancel\" class=\"btn my_btn btn-cancel\" type=\"button\"> 
                                    </div>
                                    <div class=\"\">
                                        {% if job_status.jobstatus == 1 %}
                                            <a href=\"{{ base_url() }}feedback/fixed_client?fmJob={{ job_id_encoded }}&fuser={{ fuser_id_encoded }}\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"End Contract\" />
                                            </a>
                                        {% else %}
                                            <a href=\"{{ base_url() }}endhourlyfixed/fixed_client?fmJob={{ job_id_encoded }}&fuser={{ fuser_id_encoded }}\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"End Contract\" />
                                            </a>
                                        {% endif %}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
{% endblock %}

{% block js %}
    {{ parent() }}
    {# <!-- <script data-main=\"{{ app_modular_js(\"mystaff\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script> --> #}
    <script src=\"{{ app_modular_js(\"pages/contract.js\") }}\"></script>
{% endblock %}
", "webview/jobs/twig/contract.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\contract.twig");
    }
}
