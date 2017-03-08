<?php

/* webview/jobs/partials/job-item.twig */
class __TwigTemplate_1d35c34b4593619f1d74fc3bfba3eb26398b0891f3168a0947271fdf66abf902 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "
";
        // line 2
        $context["title"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "hire_title", array());
        // line 3
        echo "                
<div class=\"row margintop-2 ms_white_box\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"col-md-5\" style=\"padding-left:-20px\">
\t\t\t<div class=\"st_img freelancer_img\">
                            <img src=\"";
        // line 11
        echo twig_escape_filter($this->env, app_user_img($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_picture", array())), "html", null, true);
        echo "\" width=\"85\" height=\"68\">
\t\t\t</div>
\t\t    </div>
                    <div class=\"col-md-7 nopadding\" style=\"padding-left: -15px !important\">
                        <div class=\"user_name\" style=\"padding-left:2px\">
\t\t            <h5 style=\"margin-bottom:0\">
                                ";
        // line 17
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_fname", array()), "html", null, true);
        echo "  ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_lname", array()), "html", null, true);
        echo "
                                <br/>
                            </h5>
\t\t\t    <span>";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "country_name", array()), "html", null, true);
        echo "</span>
\t\t\t</div>
\t\t    </div>
                </div>
            </div>
            
            ";
        // line 26
        if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_type", array()) == "hourly")) {
            // line 27
            echo "                <div class=\"col-md-4 text-center hour_info\">
                
                    ";
            // line 29
            $context["job_id"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array());
            // line 30
            echo "                    ";
            $context["fuser_id"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array());
            // line 31
            echo "                    ";
            $context["total_hour"] = 0;
            // line 32
            echo "
                    ";
            // line 33
            if ((($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array", true, true) && $this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array", false, true), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array", true, true)) && ($this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array"), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array") > 0))) {
                // line 34
                echo "                        ";
                $context["total_hour"] = $this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array"), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array");
                // line 35
                echo "                        ";
                echo sprintf(app_lang("text_job_total_hour"), (isset($context["total_hour"]) ? $context["total_hour"] : null));
                echo "
                    ";
            } else {
                // line 37
                echo "                        ";
                echo sprintf(app_lang("text_job_total_hour"), "0.00");
                echo "
                    ";
            }
            // line 39
            echo "
                    <br />

                    ";
            // line 42
            if ($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "offer_bid_amount", array())) {
                // line 43
                echo "                        ";
                $context["amount"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "offer_bid_amount", array());
                // line 44
                echo "                    ";
            } else {
                // line 45
                echo "                        ";
                $context["amount"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_amount", array());
                // line 46
                echo "                    ";
            }
            // line 47
            echo "
                    @ ";
            // line 48
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_by_hours"), (isset($context["amount"]) ? $context["amount"] : null)), "html", null, true);
            echo " = <b> \$";
            echo twig_escape_filter($this->env, ((isset($context["amount"]) ? $context["amount"] : null) * (isset($context["total_hour"]) ? $context["total_hour"] : null)), "html", null, true);
            echo "</b>

                    <br />
                    <p style=\"margin:0 !important;\">";
            // line 51
            echo twig_escape_filter($this->env, app_lang("text_job_contract_hold"), "html", null, true);
            echo "</p>
                    <hr>

                </div>
            ";
        } else {
            // line 56
            echo "                <div class=\"pay_btn\">
                    <div class=\"col-md-4 text-center\">
                        <span>
                            <b>";
            // line 59
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fixedpay_amount", array()), "html", null, true);
            echo "</b> 
                            ";
            // line 60
            echo twig_escape_filter($this->env, sprintf(app_lang("text_job_paid_of"), $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "hired_on", array())), "html", null, true);
            echo "
                            <br />
                            <p style=\"margin:0 !important;\">";
            // line 62
            echo twig_escape_filter($this->env, app_lang("text_job_contract_hold"), "html", null, true);
            echo "</p>
                        </span>
                    </div>
                </div>
            ";
        }
        // line 67
        echo "                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn\">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn\"  
                                   onclick=\"loadmessage(";
        // line 74
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_id", array()), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "user_id", array()), "html", null, true);
        echo ", ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array()), "html", null, true);
        echo ",'";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_fname", array()), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_lname", array()), "html", null, true);
        echo "','";
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "')\" 
                                   value=\"";
        // line 75
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\">
                        </div>
                    </div>
                    ";
        // line 78
        if (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_type", array()) == "hourly")) {
            // line 79
            echo "                    <div class=\"ms_hr_work_diary\">
                        <div class=\"mystaff_work_diary hour_btn work_diary_btn\">
                            <a href=\"";
            // line 81
            echo twig_escape_filter($this->env, base_url(), "html", null, true);
            echo "jobs/workdairy_client?fmJob=";
            echo twig_escape_filter($this->env, base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array())), "html", null, true);
            echo "&fuser=";
            echo twig_escape_filter($this->env, base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array())), "html", null, true);
            echo "\">
\t\t\t    <input style=\"margin-right: -1px;\" type=\"button\" class=\"btn btn-primary form-btn\" value=\"";
            // line 82
            echo twig_escape_filter($this->env, app_lang("text_job_btn_work_diary"), "html", null, true);
            echo "\" /></a>
\t\t\t</div>
  \t\t    </div>
                    ";
        } else {
            // line 86
            echo "                    <div class=\"ms_pay_butt\">
                        <div class=\"mystaff_pay_btnx payment_btn\">
                            <input type=\"button\" class=\"btn btn-primary form-btn my-btn\"
                                   value=\"";
            // line 89
            echo twig_escape_filter($this->env, app_lang("text_job_btn_payment"), "html", null, true);
            echo "\" 
                                   id=\"2\" 
                                   onclick=\"editClickedPayment(this.id)\" />
                        </div>
                    </div>    
                    ";
        }
        // line 95
        echo "                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                <li><a href=\"#\">";
        // line 101
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_contact"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"#\">";
        // line 102
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_profile"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"#\">";
        // line 103
        echo twig_escape_filter($this->env, app_lang("text_job_btn_op_end_contract"), "html", null, true);
        echo "</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"job_detais\" style=\"margin-top: -10px;\">
                    <a href=\"";
        // line 113
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "jobs/hourly_client_view?fmJob=";
        echo twig_escape_filter($this->env, base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array())), "html", null, true);
        echo "&fuser=";
        echo twig_escape_filter($this->env, base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array())), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, app_lang("text_job_link_detail"), "html", null, true);
        echo "</a>  
                    <strong>-</strong>
                    <span><b>";
        // line 115
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "</b></span>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  258 => 115,  247 => 113,  234 => 103,  230 => 102,  226 => 101,  218 => 95,  209 => 89,  204 => 86,  197 => 82,  189 => 81,  185 => 79,  183 => 78,  177 => 75,  163 => 74,  154 => 67,  146 => 62,  141 => 60,  137 => 59,  132 => 56,  124 => 51,  116 => 48,  113 => 47,  110 => 46,  107 => 45,  104 => 44,  101 => 43,  99 => 42,  94 => 39,  88 => 37,  82 => 35,  79 => 34,  77 => 33,  74 => 32,  71 => 31,  68 => 30,  66 => 29,  62 => 27,  60 => 26,  51 => 20,  43 => 17,  34 => 11,  24 => 3,  22 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("
{% set title    = job.hire_title %}
                
<div class=\"row margintop-2 ms_white_box\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"col-md-5\" style=\"padding-left:-20px\">
\t\t\t<div class=\"st_img freelancer_img\">
                            <img src=\"{{ app_user_img(job.webuser_picture) }}\" width=\"85\" height=\"68\">
\t\t\t</div>
\t\t    </div>
                    <div class=\"col-md-7 nopadding\" style=\"padding-left: -15px !important\">
                        <div class=\"user_name\" style=\"padding-left:2px\">
\t\t            <h5 style=\"margin-bottom:0\">
                                {{ job.webuser_fname }}  {{ job.webuser_lname }}
                                <br/>
                            </h5>
\t\t\t    <span>{{ job.country_name }}</span>
\t\t\t</div>
\t\t    </div>
                </div>
            </div>
            
            {% if job.job_type == 'hourly' %}
                <div class=\"col-md-4 text-center hour_info\">
                
                    {% set job_id     = job.job_id %}
                    {% set fuser_id   = job.fuser_id %}
                    {% set total_hour = 0 %}

                    {% if freelancer_job_hour[ job_id ] is defined and freelancer_job_hour[ job_id ][ fuser_id] is defined and freelancer_job_hour[ job_id ][ fuser_id]  > 0 %}
                        {% set total_hour = freelancer_job_hour[job_id][fuser_id] %}
                        {{ app_lang('text_job_total_hour')|format( total_hour )|raw }}
                    {% else %}
                        {{ app_lang('text_job_total_hour')|format( '0.00' )|raw }}
                    {% endif %}

                    <br />

                    {% if job.offer_bid_amount %}
                        {% set amount   = job.offer_bid_amount %}
                    {% else %}
                        {% set amount   = job.bid_amount %}
                    {% endif %}

                    @ {{ app_lang('text_job_by_hours')|format(amount) }} = <b> \${{ amount * total_hour }}</b>

                    <br />
                    <p style=\"margin:0 !important;\">{{ app_lang('text_job_contract_hold') }}</p>
                    <hr>

                </div>
            {% else %}
                <div class=\"pay_btn\">
                    <div class=\"col-md-4 text-center\">
                        <span>
                            <b>{{ job.fixedpay_amount }}</b> 
                            {{ app_lang('text_job_paid_of')|format(job.hired_on) }}
                            <br />
                            <p style=\"margin:0 !important;\">{{ app_lang('text_job_contract_hold') }}</p>
                        </span>
                    </div>
                </div>
            {% endif %}
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn\">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn\"  
                                   onclick=\"loadmessage({{ job.bid_id }}, {{ job.user_id }}, {{ job.fuser_id }},'{{ job.webuser_fname }} {{ job.webuser_lname }}','{{ title }}')\" 
                                   value=\"{{ app_lang('text_job_btn_message') }}\">
                        </div>
                    </div>
                    {% if job.job_type == 'hourly' %}
                    <div class=\"ms_hr_work_diary\">
                        <div class=\"mystaff_work_diary hour_btn work_diary_btn\">
                            <a href=\"{{ base_url() }}jobs/workdairy_client?fmJob={{ base64_encode(job.job_id) }}&fuser={{ base64_encode(job.fuser_id) }}\">
\t\t\t    <input style=\"margin-right: -1px;\" type=\"button\" class=\"btn btn-primary form-btn\" value=\"{{ app_lang('text_job_btn_work_diary') }}\" /></a>
\t\t\t</div>
  \t\t    </div>
                    {% else %}
                    <div class=\"ms_pay_butt\">
                        <div class=\"mystaff_pay_btnx payment_btn\">
                            <input type=\"button\" class=\"btn btn-primary form-btn my-btn\"
                                   value=\"{{ app_lang('text_job_btn_payment') }}\" 
                                   id=\"2\" 
                                   onclick=\"editClickedPayment(this.id)\" />
                        </div>
                    </div>    
                    {% endif %}
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                <li><a href=\"#\">{{ app_lang('text_job_btn_op_view_contact') }}</a></li>
                                <li><a href=\"#\">{{ app_lang('text_job_btn_op_view_profile') }}</a></li>
                                <li><a href=\"#\">{{ app_lang('text_job_btn_op_end_contract') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"col-md-12\">
                <div class=\"job_detais\" style=\"margin-top: -10px;\">
                    <a href=\"{{ base_url() }}jobs/hourly_client_view?fmJob={{ base64_encode(job.job_id) }}&fuser={{ base64_encode(job.fuser_id) }}\"> {{ app_lang('text_job_link_detail') }}</a>  
                    <strong>-</strong>
                    <span><b>{{ title }}</b></span>
                </div>
            </div>
        </div>
    </div>
</div>", "webview/jobs/partials/job-item.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-item.twig");
    }
}
