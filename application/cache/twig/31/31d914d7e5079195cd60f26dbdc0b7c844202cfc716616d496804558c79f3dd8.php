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
            <div class=\"col-md-4 text-center hour_info\">
                
                ";
        // line 27
        $context["job_id"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array());
        // line 28
        echo "                ";
        $context["fuser_id"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array());
        // line 29
        echo "                ";
        $context["total_hour"] = 0;
        // line 30
        echo "                
                ";
        // line 31
        if ((($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array", true, true) && $this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array", false, true), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array", true, true)) && ($this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array"), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array") > 0))) {
            // line 32
            echo "                    ";
            $context["total_hour"] = $this->getAttribute($this->getAttribute((isset($context["freelancer_job_hour"]) ? $context["freelancer_job_hour"] : null), (isset($context["job_id"]) ? $context["job_id"] : null), array(), "array"), (isset($context["fuser_id"]) ? $context["fuser_id"] : null), array(), "array");
            // line 33
            echo "                    ";
            echo sprintf(app_lang("text_app_total_hour"), (isset($context["total_hour"]) ? $context["total_hour"] : null));
            echo "
                ";
        } else {
            // line 35
            echo "                    ";
            echo sprintf(app_lang("text_app_total_hour"), "0.00");
            echo "
                ";
        }
        // line 37
        echo "                
                <br />
                
                ";
        // line 40
        if ($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "offer_bid_amount", array())) {
            // line 41
            echo "                    ";
            $context["amount"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "offer_bid_amount", array());
            // line 42
            echo "                ";
        } else {
            // line 43
            echo "                    ";
            $context["amount"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_amount", array());
            // line 44
            echo "                ";
        }
        // line 45
        echo "                
                @ ";
        // line 46
        echo twig_escape_filter($this->env, sprintf(app_lang("text_app_by_hours"), (isset($context["amount"]) ? $context["amount"] : null)), "html", null, true);
        echo " = <b> \$";
        echo twig_escape_filter($this->env, ((isset($context["amount"]) ? $context["amount"] : null) * (isset($context["total_hour"]) ? $context["total_hour"] : null)), "html", null, true);
        echo "</b>
                
                <br />
                <p style=\"margin:0 !important;\">";
        // line 49
        echo twig_escape_filter($this->env, app_lang("text_app_contract_hold"), "html", null, true);
        echo "</p>
                <hr>
                                
            </div>
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn\">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn\"  
                                   onclick=\"loadmessage(";
        // line 60
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
        // line 61
        echo twig_escape_filter($this->env, app_lang("text_mystaff_btn_message"), "html", null, true);
        echo "\">
                        </div>
                    </div>
                    <div class=\"ms_hr_work_diary\">
                        <div class=\"mystaff_work_diary hour_btn work_diary_btn\">
                            <a href=\"";
        // line 66
        echo twig_escape_filter($this->env, base_url(), "html", null, true);
        echo "jobs/workdairy_client?fmJob=";
        echo twig_escape_filter($this->env, base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array())), "html", null, true);
        echo "&fuser=";
        echo twig_escape_filter($this->env, base64_encode($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "fuser_id", array())), "html", null, true);
        echo "\">
\t\t\t    <input style=\"margin-right: -1px;\" type=\"button\" class=\"btn btn-primary form-btn\" value=\"";
        // line 67
        echo twig_escape_filter($this->env, app_lang("text_mystaff_btn_work_diary"), "html", null, true);
        echo "\" /></a>
\t\t\t</div>
  \t\t   </div>
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                <li><a href=\"#\">";
        // line 76
        echo twig_escape_filter($this->env, app_lang("text_mystaff_btn_op_view_contact"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"#\">";
        // line 77
        echo twig_escape_filter($this->env, app_lang("text_mystaff_btn_op_view_profile"), "html", null, true);
        echo "</a></li>
                                <li><a href=\"#\">";
        // line 78
        echo twig_escape_filter($this->env, app_lang("text_mystaff_btn_op_end_contract"), "html", null, true);
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
        // line 88
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
        // line 90
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
        return array (  207 => 90,  196 => 88,  183 => 78,  179 => 77,  175 => 76,  163 => 67,  155 => 66,  147 => 61,  133 => 60,  119 => 49,  111 => 46,  108 => 45,  105 => 44,  102 => 43,  99 => 42,  96 => 41,  94 => 40,  89 => 37,  83 => 35,  77 => 33,  74 => 32,  72 => 31,  69 => 30,  66 => 29,  63 => 28,  61 => 27,  51 => 20,  43 => 17,  34 => 11,  24 => 3,  22 => 2,  19 => 1,);
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
            <div class=\"col-md-4 text-center hour_info\">
                
                {% set job_id     = job.job_id %}
                {% set fuser_id   = job.fuser_id %}
                {% set total_hour = 0 %}
                
                {% if freelancer_job_hour[ job_id ] is defined and freelancer_job_hour[ job_id ][ fuser_id] is defined and freelancer_job_hour[ job_id ][ fuser_id]  > 0 %}
                    {% set total_hour = freelancer_job_hour[job_id][fuser_id] %}
                    {{ app_lang('text_app_total_hour')|format( total_hour )|raw }}
                {% else %}
                    {{ app_lang('text_app_total_hour')|format( '0.00' )|raw }}
                {% endif %}
                
                <br />
                
                {% if job.offer_bid_amount %}
                    {% set amount   = job.offer_bid_amount %}
                {% else %}
                    {% set amount   = job.bid_amount %}
                {% endif %}
                
                @ {{ app_lang('text_app_by_hours')|format(amount) }} = <b> \${{ amount * total_hour }}</b>
                
                <br />
                <p style=\"margin:0 !important;\">{{ app_lang('text_app_contract_hold') }}</p>
                <hr>
                                
            </div>
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn\">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn\"  
                                   onclick=\"loadmessage({{ job.bid_id }}, {{ job.user_id }}, {{ job.fuser_id }},'{{ job.webuser_fname }} {{ job.webuser_lname }}','{{ title }}')\" 
                                   value=\"{{ app_lang('text_mystaff_btn_message') }}\">
                        </div>
                    </div>
                    <div class=\"ms_hr_work_diary\">
                        <div class=\"mystaff_work_diary hour_btn work_diary_btn\">
                            <a href=\"{{ base_url() }}jobs/workdairy_client?fmJob={{ base64_encode(job.job_id) }}&fuser={{ base64_encode(job.fuser_id) }}\">
\t\t\t    <input style=\"margin-right: -1px;\" type=\"button\" class=\"btn btn-primary form-btn\" value=\"{{ app_lang('text_mystaff_btn_work_diary') }}\" /></a>
\t\t\t</div>
  \t\t   </div>
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                <li><a href=\"#\">{{ app_lang('text_mystaff_btn_op_view_contact') }}</a></li>
                                <li><a href=\"#\">{{ app_lang('text_mystaff_btn_op_view_profile') }}</a></li>
                                <li><a href=\"#\">{{ app_lang('text_mystaff_btn_op_end_contract') }}</a></li>
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
