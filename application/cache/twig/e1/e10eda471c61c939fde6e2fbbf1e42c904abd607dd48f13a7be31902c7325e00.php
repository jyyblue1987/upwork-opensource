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
        // line 6
        echo twig_escape_filter($this->env, base_url("assets/css/pages/job-common.css"), "html", null, true);
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 7
        echo twig_escape_filter($this->env, base_url("assets/css/pages/contract.css"), "html", null, true);
        echo "\">
";
    }

    // line 10
    public function block_content($context, array $blocks = array())
    {
        // line 11
        echo "    
    ";
        // line 12
        $context["job_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()));
        // line 13
        echo "    ";
        $context["fuser_id_encoded"] = base64_encode($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()));
        // line 14
        echo "    
    <section id=\"big_header\" class=\"contract-section\">
        <div class=\"container\">
            <div class=\"row \">
                <div style=\"border: 1px solid #ccc;border-radius: 4px 4px 0 0px;margin: 0;\" class=\"col-md-9 white-box black-box\">
                    <div class=\"row\">
                        <div class=\"date_head\">
                            <div class=\"col-md-6\">";
        // line 21
        echo twig_escape_filter($this->env, sprintf(app_lang("text_job_since"), app_date($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "start_date", array()), " M j, Y ")), "html", null, true);
        echo "</div>
                            <div class=\"col-md-6\">
                                <div class=\"main_id\">
                                    <span>ID ";
        // line 24
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
        // line 34
        echo twig_escape_filter($this->env, app_user_img($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "cropped_image", array())), "html", null, true);
        echo "\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <h5 style=\"margin-top: -4px;\" class=\"free_name\">";
        // line 38
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "html", null, true);
        echo "</label>
                                        <br> <p class=\"\"><strong>";
        // line 39
        echo twig_escape_filter($this->env, character_limiter($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "tagline", array()), 36, "..."), "html", null, true);
        echo "</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class=\"col-md-3 text-center gray-text\">
                            <div style=\"margin-top: -8px;\" class=\"status_bar\">
                                ";
        // line 45
        if (($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "jobstatus", array()) == 1)) {
            // line 46
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_ended")), "html", null, true);
            echo "</label>
                                ";
        } else {
            // line 48
            echo "                                    <label class=\"gray-text\">";
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_status_state"), app_lang("text_job_state_actived")), "html", null, true);
            echo "</label>
                                ";
        }
        // line 50
        echo "                            </div>
                        </div>
                        <div class=\"col-md-3 col-md-offset-1\">
                            <div class=\"msg_btnx hour_btn\">
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button _job_btn_message\" 
                                       value=\"";
        // line 55
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\" 
                                       data-bid=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_id", array()), "html", null, true);
        echo "\"
                                       data-uid=\"";
        // line 57
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()), "html", null, true);
        echo "\"
                                       data-jid=\"";
        // line 58
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()), "html", null, true);
        echo "\" 
                                       />
                            </div>
                        </div>
                        
                        <div class=\"col-md-12\">
                            <div class=\"job_title client_job_title\">
                                <span class=\"clint_view_j-title\"> 
                                    ";
        // line 66
        if (twig_test_empty($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array()))) {
            // line 67
            echo "                                       ";
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "title", array());
            // line 68
            echo "                                    ";
        } else {
            // line 69
            echo "                                        ";
            $context["job_title"] = $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hire_title", array());
            // line 70
            echo "                                    ";
        }
        // line 71
        echo "                                    ";
        echo twig_escape_filter($this->env, character_limiter((isset($context["job_title"]) ? $context["job_title"] : null), 35, "..."), "html", null, true);
        echo "</span><br />
                                <a href=\"";
        // line 72
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
        // line 89
        echo twig_escape_filter($this->env, app_lang("text_job_contract_amount"), "html", null, true);
        echo "</b>
                               </div>
                               <div style=\"padding-top: 5px; border-left: 2px solid #ededed; margin-right: 10px;\" class=\"col-md-4 text-centered text-center\">
                                   <b>";
        // line 92
        echo twig_escape_filter($this->env, app_lang("text_job_contract_paid"), "html", null, true);
        echo "</b>
                               </div>
                               <div style=\"width: 76px; padding-top: 5px; margin-left: 0px; padding-left: 83px; border-left: 2px solid rgb(237, 237, 237);\" 
                                    class=\"col-md-4 text-centered text-center\">
                                   <b>";
        // line 96
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
        // line 105
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "hired_on", array()), "html", null, true);
        echo "
                                       </span>
                                   </div>
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4 text-center nav-bar-item\">
                                       <span class=\"bold_text\">
                                           ";
        // line 110
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fixedpay_amount", array()), "html", null, true);
        echo "
                                       </span>
                                   </div>
                                   <div style=\"padding-bottom: 5px;\" class=\"col-md-4  text-center nav-bar-item\">
                                       <span class=\"bold_text\">

                                           ";
        // line 116
        $context["remain_budget"] = ($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "bid_amount", array()) - $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fixedpay_amount", array()));
        // line 117
        echo "
                                           ";
        // line 118
        if (((isset($context["remain_budget"]) ? $context["remain_budget"] : null) < 0)) {
            // line 119
            echo "                                               ";
            $context["remain_budget"] = 0;
            // line 120
            echo "                                           ";
        }
        // line 121
        echo "
                                           \$";
        // line 122
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
        // line 133
        echo "                    ";
        echo twig_include($this->env, $context, "webview/jobs/partials/job-transactions.twig", array("payments" => (isset($context["payments"]) ? $context["payments"] : null), "job_status" => (isset($context["job_status"]) ? $context["job_status"] : null)), false);
        echo "
                    
                    <div class=\"row margin-top-5 margin-bottom-2\">
                        <div class=\"col-md-10 col-md-offset-1\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"\">
                                        <input style=\"float: left;margin-left: 0;\" type=\"button\" class=\"btn my_btn btn-cancel _job_add_milestone\" 
                                               value=\"";
        // line 141
        echo twig_escape_filter($this->env, app_lang("text_job_btn_add_milestone"), "html", null, true);
        echo "\" 
                                               data-id =\"2\" 
                                               data-buserid=\"";
        // line 143
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "buser_id", array()), "html", null, true);
        echo "\"
                                               data-fuserid=\"";
        // line 144
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()), "html", null, true);
        echo "\"
                                               data-jobid=\"";
        // line 145
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()), "html", null, true);
        echo "\" />
                                    </div>
                                    <input style=\"margin-left: 15px;\" type=\"button\" class=\"btn my_btn btn-cancel _job_btn_payment\" 
                                           value=\"";
        // line 148
        echo twig_escape_filter($this->env, app_lang("text_job_btn_payment"), "html", null, true);
        echo "\"  
                                           data-id =\"2\"
                                           data-buserid=\"";
        // line 150
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "buser_id", array()), "html", null, true);
        echo "\"
                                           data-fuserid=\"";
        // line 151
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "fuser_id", array()), "html", null, true);
        echo "\"
                                           data-jobid=\"";
        // line 152
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "job_id", array()), "html", null, true);
        echo "\"
                                           />
                                </div>
                                <div class=\"col-md-6\">
                                    <div style=\"float: left; position: absolute;right: 143px;\" class=\"cancel_content_btn\">
                                        <input value=\"";
        // line 157
        echo twig_escape_filter($this->env, app_lang("text_job_transaction_cancelled"), "html", null, true);
        echo "\" class=\"btn my_btn btn-cancel\" type=\"button\"> 
                                    </div>
                                    <div class=\"\">
                                        ";
        // line 160
        if (($this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "jobstatus", array()) == 1)) {
            // line 161
            echo "                                            <a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "feedback/fixed_client?fmJob=";
            echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
            echo "&fuser=";
            echo twig_escape_filter($this->env, (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null), "html", null, true);
            echo "\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"";
            // line 162
            echo twig_escape_filter($this->env, app_lang("text_job_btn_op_end_contract"), "html", null, true);
            echo "\" />
                                            </a>
                                        ";
        } else {
            // line 165
            echo "                                            <a href=\"";
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "endhourlyfixed/fixed_client?fmJob=";
            echo twig_escape_filter($this->env, (isset($context["job_id_encoded"]) ? $context["job_id_encoded"] : null), "html", null, true);
            echo "&fuser=";
            echo twig_escape_filter($this->env, (isset($context["fuser_id_encoded"]) ? $context["fuser_id_encoded"] : null), "html", null, true);
            echo "\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"";
            // line 166
            echo twig_escape_filter($this->env, app_lang("text_job_btn_op_end_contract"), "html", null, true);
            echo "\" />
                                            </a>
                                        ";
        }
        // line 169
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
        // line 179
        echo twig_include($this->env, $context, "webview/modals/message-conversion-modal.twig", array("webuser_fname" => $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_fname", array()), "webuser_lname" => $this->getAttribute((isset($context["job_status"]) ? $context["job_status"] : null), "webuser_lname", array()), "job_title" => (isset($context["job_title"]) ? $context["job_title"] : null)));
        echo "
        
    ";
        // line 181
        echo twig_include($this->env, $context, "webview/modals/milestone-modal.twig");
        echo "

    ";
        // line 183
        echo twig_include($this->env, $context, "webview/modals/payment-modal.twig");
        echo "
    
";
    }

    // line 187
    public function block_js($context, array $blocks = array())
    {
        // line 188
        echo "    
    ";
        // line 190
        echo "    <script> var page = 'contract'; </script>
    
    <script data-main=\"";
        // line 192
        echo twig_escape_filter($this->env, app_modular_js("winjob"), "html", null, true);
        echo "\" src=\"";
        echo twig_escape_filter($this->env, app_modular_js("lib/require.dev.js"), "html", null, true);
        echo "\"></script>
    <script src=\"";
        // line 193
        echo twig_escape_filter($this->env, site_url("assets/js/vendor/modernizr-2.8.3.min.js"), "html", null, true);
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
        return array (  403 => 193,  397 => 192,  393 => 190,  390 => 188,  387 => 187,  380 => 183,  375 => 181,  370 => 179,  358 => 169,  352 => 166,  343 => 165,  337 => 162,  328 => 161,  326 => 160,  320 => 157,  312 => 152,  308 => 151,  304 => 150,  299 => 148,  293 => 145,  289 => 144,  285 => 143,  280 => 141,  268 => 133,  255 => 122,  252 => 121,  249 => 120,  246 => 119,  244 => 118,  241 => 117,  239 => 116,  230 => 110,  222 => 105,  210 => 96,  203 => 92,  197 => 89,  173 => 72,  168 => 71,  165 => 70,  162 => 69,  159 => 68,  156 => 67,  154 => 66,  143 => 58,  139 => 57,  135 => 56,  131 => 55,  124 => 50,  118 => 48,  112 => 46,  110 => 45,  101 => 39,  95 => 38,  88 => 34,  75 => 24,  69 => 21,  60 => 14,  57 => 13,  55 => 12,  52 => 11,  49 => 10,  43 => 7,  39 => 6,  33 => 4,  30 => 3,  11 => 1,);
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
    
    <link rel=\"stylesheet\" href=\"{{ base_url(\"assets/css/pages/job-common.css\") }}\">
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
                                        <img src=\"{{ app_user_img( job_status.cropped_image ) }}\" width=\"64\" height=\"64\" />
                                    </div>
                                </div>
                                <div style=\"margin-left: -24px;\" class=\"col-md-7 text-left\">
                                    <h5 style=\"margin-top: -4px;\" class=\"free_name\">{{ job_status.webuser_fname }} {{ job_status.webuser_lname }}</label>
                                        <br> <p class=\"\"><strong>{{ character_limiter(job_status.tagline, 36, '...') }}</strong></p>
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
                                <input type=\"button\" class=\"btn-primary transparent-btn big_mass_button _job_btn_message\" 
                                       value=\"{{ app_lang('text_job_btn_message') }}\" 
                                       data-bid=\"{{ job_status.bid_id }}\"
                                       data-uid=\"{{ job_status.fuser_id }}\"
                                       data-jid=\"{{ job_status.job_id }}\" 
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
                                    {{ character_limiter(job_title, 35, '...') }}</span><br />
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
                    {{ include(\"webview/jobs/partials/job-transactions.twig\", {payments: payments, job_status: job_status}, with_context= false) }}
                    
                    <div class=\"row margin-top-5 margin-bottom-2\">
                        <div class=\"col-md-10 col-md-offset-1\">
                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"\">
                                        <input style=\"float: left;margin-left: 0;\" type=\"button\" class=\"btn my_btn btn-cancel _job_add_milestone\" 
                                               value=\"{{ app_lang('text_job_btn_add_milestone') }}\" 
                                               data-id =\"2\" 
                                               data-buserid=\"{{ job_status.buser_id }}\"
                                               data-fuserid=\"{{ job_status.fuser_id }}\"
                                               data-jobid=\"{{ job_status.job_id }}\" />
                                    </div>
                                    <input style=\"margin-left: 15px;\" type=\"button\" class=\"btn my_btn btn-cancel _job_btn_payment\" 
                                           value=\"{{ app_lang('text_job_btn_payment') }}\"  
                                           data-id =\"2\"
                                           data-buserid=\"{{ job_status.buser_id }}\"
                                           data-fuserid=\"{{ job_status.fuser_id }}\"
                                           data-jobid=\"{{ job_status.job_id }}\"
                                           />
                                </div>
                                <div class=\"col-md-6\">
                                    <div style=\"float: left; position: absolute;right: 143px;\" class=\"cancel_content_btn\">
                                        <input value=\"{{ app_lang('text_job_transaction_cancelled') }}\" class=\"btn my_btn btn-cancel\" type=\"button\"> 
                                    </div>
                                    <div class=\"\">
                                        {% if job_status.jobstatus == 1 %}
                                            <a href=\"{{ base_url() }}feedback/fixed_client?fmJob={{ job_id_encoded }}&fuser={{ fuser_id_encoded }}\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"{{ app_lang('text_job_btn_op_end_contract') }}\" />
                                            </a>
                                        {% else %}
                                            <a href=\"{{ base_url() }}endhourlyfixed/fixed_client?fmJob={{ job_id_encoded }}&fuser={{ fuser_id_encoded }}\">
                                                <input style=\"float: right;margin-right: 0px;\" type=\"button\" class=\"btn my_btn btn-default_activv\" value=\"{{ app_lang('text_job_btn_op_end_contract') }}\" />
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
    
    {{ include('webview/modals/message-conversion-modal.twig', {'webuser_fname': job_status.webuser_fname, 'webuser_lname': job_status.webuser_lname , 'job_title': job_title }) }}
        
    {{ include(\"webview/modals/milestone-modal.twig\") }}

    {{ include(\"webview/modals/payment-modal.twig\") }}
    
{% endblock %}

{% block js %}
    
    {# this variable defines the asset/modular/pages file to load #}
    <script> var page = 'contract'; </script>
    
    <script data-main=\"{{ app_modular_js(\"winjob\") }}\" src=\"{{ app_modular_js(\"lib/require.dev.js\") }}\"></script>
    <script src=\"{{ site_url(\"assets/js/vendor/modernizr-2.8.3.min.js\") }}\"></script>
    {# <script src=\"{{ app_modular_js(\"pages/contract.js\") }}\"></script> #}
{% endblock %}
", "webview/jobs/twig/contract.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\twig\\contract.twig");
    }
}
