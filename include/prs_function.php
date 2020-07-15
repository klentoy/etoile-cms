<?php
class get_pageing
{
    var $record_per_page = 10;
    var $pages = 5;
    var $tbl, $file_names, $order, $query, $orderFront, $orderFront2;

    ///////// GET THE VALUE OF START VARIABLE////////////////CREATED BY
    function start()
    {
        if (isset($_GET["start"])) return $start = $_GET["start"];
        else return $start = 0;
    }
    function start1()
    {
        if ($_GET["start1"]) return $start = $_GET["start1"];
        else return $start = 0;
    }

    function start2()
    {
        if ($_GET["start"]) return $start = $_GET["start"];
        else return $start = 1;
    }
    //////////////  END OF START FUNCTION///////////////////CREATED BY
    //////////////  GET THE CURRENT FILE NAME ///////////////////CREATED BY
    function file_names()
    {
        //$pt=explode("/",$_SERVER['SCRIPT_FILENAME']);
        $pt = explode("/", $_SERVER['PHP_SELF']);
        $totpt = count($pt);
        return $this->file_names = $pt[$totpt - 1];
    }
    //////////////  END OF FILE_NAME FUNCTION///////////////////CREATED BY
    //////////////  DISPLAY THE NUMERIC PAGING WITHOUT RECORD DETAIL///////////////////CREATED BY
    function number_pageing_nodetail($query, $record_per_page = '', $pages = '')
    {
        return $this->number_pageing($query, $record_per_page, $pages, "N");
    }

    function number_pageing_bottom_nodetail($query, $record_per_page = '', $pages = '')
    {
        return $this->number_pageing($query, $record_per_page, $pages, "N", "Y");
    }

    function number_pageing_bottom($query, $record_per_page = '', $pages = '')
    {
        return $this->number_pageing($query, $record_per_page, $pages, "", "Y");
	}
	
    function number_pageing_bottom_admin($query, $record_per_page = '', $pages = '')
    {
        return $this->number_pageing_admin($query, $record_per_page, $pages, "Y", "Y");
    }

    //////////////  END OF NUMERIC PAGING FUNCTION ///////////////////CREATED BY
    ////////////////////By yogesh//////////////
    function number_pageing_nodetail_dress($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress($query, $record_per_page, $pages, "N", '', '', $color, $NextPage);
    }
    function number_pageing_nodetail_dress_test($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress_test($query, $record_per_page, $pages, "N", '', '', $color, $NextPage);
    }
    function number_pageing_nodetail_dress_test1($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress_test1($query, $record_per_page, $pages, "N", "Y", '', $color, $NextPage);
    }
    function number_pageing_nodetail_runwaysub($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_runwaysub($query, $record_per_page, $pages, "N", "Y", '', $color, $NextPage);
    }
    function number_pageing_nodetail_dress_test2($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress_test2($query, $record_per_page, $pages, "N", "Y", '', $color, $NextPage);
    }
    function number_pageing_nodetail_dress_continue($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress_continue($query, $record_per_page, $pages, "N", "Y", '', $color, $NextPage);
    }
    function number_pageing_nodetail_dress_continue_designer($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress_continue_designer($query, $record_per_page, $pages, "N", "Y", '', $color, $NextPage);
    }

    function number_pageing_bottom_onphoto($query, $record_per_page = '', $pages = '')
    {
        return $this->number_pageing_onphoto($query, $record_per_page, $pages, "", "Y");
    }
    function number_pageing_top_newarrival($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_newarrival($query, $record_per_page, $pages, "N", '', '', $color, $NextPage);
    }
    function number_pageing_nodetail_dress_3box($query, $record_per_page = '', $pages = '', $color, $NextPage)
    {
        return $this->number_pageing_dress_3box($query, $record_per_page, $pages, "N", "Y", '', $color, $NextPage);
    }

    function number_pageing_bottom_profilecontacts($query, $record_per_page = '', $pages = '', $pagename)
    {
        return $this->number_pageing_bottom_profilecontacts_sub($query, $record_per_page, $pages, "", "Y", "", $pagename);
    }
    ////////////////////End by yogesh//////////
    function runquery($query)
    {
		$db = new Database;
        return $db->db_query($query);
    }

    function table($result, $titles, $fields, $passfield = "", $edit, $delete, $parent = "")
    {
		$db = new Database;
        if ($parent == "") $parent = "Y";

        if ($passfield == "") $passfield = "id";
		$cont1 = "";
        $cont = "<table width='100%' cellspacing='0' cellpadding='3' border='0' ><tr>";
        foreach ($titles as $K => $V)
        {
            $cont1 .= "<td";
            $cont1 .= (is_numeric($V)) ? " width='$V%' align='center'><strong>$K</strong></td>" : " align='center'><strong>$V</strong></td>";
        }
        $cont .= $cont1 . "</tr>";
        $cont .= "<tr><td colspan='" . count($titles) . "'><script language=javascript>msg=\"<table border=0 cellpadding=3 cellspacing=1 width='100%'><TR>$cont1</TR></table>\";
		</script>
		<script src='topmsg.js'></script>			
		</td></tr>";
        $j = 0;
        while ($gets = $db->db_fetch_obj($result))
        {
            $j = 1;
            $cont .= "<tr onmouseover=\"this.className='yellowdark3bdr'\" onmouseout=\"this.className=''\">";
            foreach ($fields as $K => $V)
            {
                $cont .= "<td align='center'>";
                $tmps = explode(",", $V);
                $newval = "";
                foreach ($tmps as $val)
                {
                    $newval .= $gets->$val . " ";
                }
                $cont .= (is_numeric($K)) ? $newval : "<a href='$K?$passfield=" . $gets->$passfield . "' onmouseover=\"smsg('View Detail of " . addslashes($newval) . "');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $newval . "</a>";
                $cont .= "&nbsp;</td>";
            }
            $cont .= "<td><INPUT name='button' type='button' onClick=\"";
            $cont .= ($parent == "N") ? "window" : "parent.body";
            $cont .= ".location.href='$edit?$passfield=" . $gets->$passfield . "'\" value='Edit' onmouseover=\"smsg('Edit This Record -> $newval');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">&nbsp;&nbsp;<INPUT onClick=\"deleteconfirm('Are you sure you want to delete this Record?.','$delete?$passfield=" . $gets->$passfield . "');\" type='button' value='Delete' onmouseover=\"smsg('Delete This Record -> $newval');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">&nbsp;</td>";
            $cont .= "</tr>";
        }

        if ($j == 0)
        {
            $cont .= "<tr><td colspan='" . (count($fields) + 1) . "' align='center'><font color='red'><strong>No Record To Display</strong></font></td></tr>";
        }
        echo $cont .= "</table>";
    }
    ///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////
    function number_pageing($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '')
    {
		$db = new Database;

        $this->file_names();
        $this->query = $query;

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        // $totalrows = mysql_affected_rows();
        $totalrows = $db->db_num($query);

        $start = $this->start();

        $order = isset($_GET['order']);
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        // $total = mysql_affected_rows();
        $total = $totalrows;

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";

        if ($start > 0)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start - $this->record_per_page) . $tmpva . "'  class='ttt'  >&lt;&lt;Previous</a>&nbsp;&nbsp;";
        }

        $this->tbl .= "</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
        if ($detail != "N" and $simple != "N") $this->tbl .= "<strong>Result " . ($start + 1) . " - " . ($start + $total) . " of " . $totalrows . " Records</strong><BR>";
        if ($simple != 'N')
        {
            for ($i = $start_loop;$i < $end_loop;$i++)
            {
                if ($current_page == $i)
                {
                    $this->tbl .= "<strong><span class='ttt'>" . $i . "</span></strong>&nbsp;&nbsp;";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start=" . ($i - 1) * $this->record_per_page . $tmpva . "'  class='ttt' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a></strong>&nbsp;&nbsp;";
                }
            }
        }

        $this->tbl .= "&nbsp;</td><td width='15%' align='right'><strong>";
        if ($start + $this->record_per_page < $totalrows)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start + $this->record_per_page) . $tmpva . "' class='ttt' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>";
        }
        $this->tbl .= "&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    function number_pageing_admin($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '')
    {

        $this->file_names();
        $this->query = $query;

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start();

        $order = $_GET['order'];
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";

        if ($start > 0)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start - $this->record_per_page) . $tmpva . "'  class='ttt'  >&lt;&lt;Previous</a>&nbsp;&nbsp;";
        }

        $this->tbl .= "</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
        if ($detail != "N" and $simple != "N") $this->tbl .= "<strong>Result " . ($start + 1) . " - " . ($start + $total) . " of " . $totalrows . " Records</strong><BR>";
        if ($simple != 'N')
        {
            for ($i = $start_loop;$i < $end_loop;$i++)
            {
                if ($current_page == $i)
                {
                    $this->tbl .= "<strong><span class='ttt'>" . $i . "</span></strong>&nbsp;&nbsp;";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start=" . ($i - 1) * $this->record_per_page . $tmpva . "'  class='ttt' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a></strong>&nbsp;&nbsp;";
                }
            }
        }

        $this->tbl .= "&nbsp;</td><td width='15%' align='right'><strong>";
        if ($start + $this->record_per_page < $totalrows)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start + $this->record_per_page) . $tmpva . "' class='ttt' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>";
        }
        $this->tbl .= "&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    ////////////
    function number_pageing_admin_with_alldetail($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '')
    {

        $this->file_names();
        $this->query = $query;

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start();

        $order = $_GET['order'];
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";

        if ($start > 0)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start - $this->record_per_page) . $tmpva . "'  class='ttt'  >&lt;&lt;Previous</a>&nbsp;&nbsp;";
        }

        $this->tbl .= "</strong>&nbsp;</td><td width='70%' class='blogDate'  align='center'>&nbsp;";
        if ($detail != "N" and $simple != "N") $this->tbl .= "<strong>Result " . ($start + 1) . " - " . ($start + $total) . " of " . $totalrows . " Records</strong><BR>";
        if ($simple != 'N')
        {
            for ($i = $start_loop;$i < $end_loop;$i++)
            {
                if ($current_page == $i)
                {
                    $this->tbl .= "<strong><span class='ttt'>" . $i . "</span></strong>&nbsp;&nbsp;";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start=" . ($i - 1) * $this->record_per_page . $tmpva . "'  class='ttt' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a></strong>&nbsp;&nbsp;";
                }
            }
        }

        $this->tbl .= "&nbsp;</td><td width='15%' align='right'><strong>";
        if ($start + $this->record_per_page < $totalrows)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start + $this->record_per_page) . $tmpva . "' class='ttt' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">Next&gt;&gt;</a>";
        }
        $this->tbl .= "&nbsp;&nbsp;</strong>&nbsp;</td></tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    ////////////
    //////////////////By yogesh////////////////
    ///////////// NUMERIC FUNCTION WITH RECORD DESTAIL//////////////////////////////////////
    function number_pageing_onphoto($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '')
    {

        $this->file_names();
        $this->query = $query;

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start1();

        $order = $_GET['order'];
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start1") $tmpva .= "&amp;" . $V . "=" . $K;
        }

        $this->tbl = "<table width='100%' border='0' cellpadding='0' cellspacing='0' align='center' ><tr><td width='15%' align='left'><strong>";

        if ($start > 0)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start1=" . ($start - $this->record_per_page) . $tmpva . "'  class='arial12-white'  ><img src='images/minus.jpg' border='0' alt='Previous'/></a>";
        }

        $this->tbl .= "</strong></td><td width='70%' class='arial11-black2'  align='center'>OTHER VIEWS&nbsp;&nbsp;";
        /*		if($detail!="N" and $simple !="N")
        $this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
        */
        if ($simple != 'N')
        {
            for ($i = $start_loop;$i < $end_loop;$i++)
            {
                if ($end_loop - 1 == $i)
                {
                    $Nbspace = "";
                }
                else
                {
                    $Nbspace = "&nbsp;&nbsp;";
                }
                if ($current_page == $i)
                {
                    $this->tbl .= "<strong><span class='arial11-black2'>" . $i . "</span></strong>$Nbspace";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start1=" . ($i - 1) * $this->record_per_page . $tmpva . "'  class='grey-11' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a></strong>$Nbspace";
                }
            }
        }

        $this->tbl .= "</td><td width='15%' align='right'><strong>";
        if ($start + $this->record_per_page < $totalrows)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start1=" . ($start + $this->record_per_page) . $tmpva . "' class='grey-11' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\"><img src='images/plus.jpg' border='0' alt='Next'/></a>";
        }
        $this->tbl .= "</strong></td></tr></table>";

        /*if($start+$this->record_per_page<$totalrows)
        {
        $this->tbl.="</td><td width='15%' align='right'><strong>";
        $this->tbl.="<a href='".$this->file_names."?start1=".($start+$this->record_per_page).$tmpva."' class='grey-11' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\"><img src='images/plus.jpg' border='0'></a>";
        $this->tbl.="</strong></td></tr></table>";
        }
        else
        {
        $this->tbl.="</td>";
        $this->tbl.="</tr></table>";
        }*/

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    ////////////
    function number_pageing_dress($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start();

        $order = $_GET['order'];
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='15%' align='left'><strong>&nbsp;&nbsp;";

        if ($start > 0)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start - $this->record_per_page) . $tmpva . "'  class='" . $otherclass . "'  >PREV</a>&nbsp;";
        }

        $this->tbl .= "</strong></td><td width='70%' class='blogDate'  align='right'>";
        /*		if($detail!="N" and $simple !="N")
        $this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
        */
        if ($simple != 'N')
        {
            for ($i = $start_loop;$i < $end_loop;$i++)
            {
                if ($current_page == $i)
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>&nbsp;&nbsp;";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start=" . ($i - 1) * $this->record_per_page . $tmpva . "'  class='" . $otherclass . "' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a></strong>&nbsp;&nbsp;";
                }
            }
        }

        if ($start + $this->record_per_page < $totalrows)
        {
            $this->tbl .= "</td><td width='15%' align='right'><strong>";
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start + $this->record_per_page) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $NextPage . "</a>";
            $this->tbl .= "</strong></td></tr></table>";
        }
        else
        {
            $this->tbl .= "</td>";
            $this->tbl .= "</tr></table>";
        }
        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }

    function number_pageing_dress_test($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();

        if ($start > 1)
        {
            $newstart = ($start - 1) * $this->record_per_page;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        /*$total_pages=ceil($totalrows/$this->record_per_page);
        $current_page=($start+$this->record_per_page)/$this->record_per_page;
        $loop_counter=ceil($current_page/$this->pages);
        $start_loop=($loop_counter*$this->pages-$this->pages)+1;
        $end_loop=($this->pages*$loop_counter)+1;
        
        if($end_loop>$total_pages)
        $end_loop=$total_pages+1;*/

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='150' height='100%' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'><strong>";

        /*if($start>0)
        {
        $this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='".$otherclass."'  >PREV</a>&nbsp;";
        }
        
        $this->tbl.="</strong></td><td width='70%' class='blogDate'  align='right'>";
        /*if($simple!='N')
        {
        for($i=$start_loop;$i<$end_loop;$i++)
        {
        if($current_page==$i)
        {
        $this->tbl.="<strong><span class='".$selclass."'>".$i."</span></strong>&nbsp;&nbsp;";
        }
        else
        {
        $this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='".$otherclass."' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;";
        }
        }
        }
        
        if($start+$this->record_per_page<$totalrows)
        {
        $this->tbl.="</td><td width='15%' align='right'><strong>";
        $this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$NextPage."</a>";
        $this->tbl.="</strong></td></tr></table>";
        }
        else
        {
        $this->tbl.="</td>";
        $this->tbl.="</tr></table>";
        }*/
        $totpage = ceil($totalrows / $this->record_per_page);

        if ($totpage <= 5)
        {

            for ($i = 1;$i <= $totpage;$i++)
            {
                if ($i == $totpage)
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($i != $start)
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($i) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
                }
                else
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
                }
            }
        }
        else
        {
            $temp1 = 0;
            $temp = 0;
            $temp = $start - ($start % 5);

            if ($start % 5 == 0)
            {
                $temp = $start - 4;
            }
            else
            {
                $temp = $temp;
            }

            if ($start + 4 == $totpage)
            {
                $temp1 = $totpage;
            }
            else if ($start == "1")
            {
                $temp1 = $start + 5;
            }
            else
            {
                $temp1 = $start + 4;
            }

            for ($n = $start;$n < $temp1;$n++)
            {
                if ($n > $totpage) break;
                if ($n == ($temp1 - 1))
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($start == $n)
                {
                    if ($start > 1) $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n - 1) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . ($n - 1) . "</a>$blnkspace1";

                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $n . "</span></strong>$blnkspace1";
                    //$this->tbl.=$n."&nbsp;&nbsp;";
                    
                }
                else
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a>$blnkspace1";
                }
            }

        }

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }

    function number_pageing_dress_test1($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();

        if ($start > 1)
        {
            $newstart = ($start - 1) * $this->record_per_page;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        /*$total_pages=ceil($totalrows/$this->record_per_page);
        $current_page=($start+$this->record_per_page)/$this->record_per_page;
        $loop_counter=ceil($current_page/$this->pages);
        $start_loop=($loop_counter*$this->pages-$this->pages)+1;
        $end_loop=($this->pages*$loop_counter)+1;
        
        if($end_loop>$total_pages)
        $end_loop=$total_pages+1;*/

        /*$tmpva="";
        foreach($_GET as $V=>$K)
        {
        if($V!="start")
        $tmpva.="&".$V."=".$K;
        }*/

        $this->tbl = "<table width='150' height='100%' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'><strong>";

        /*if($start>0)
        {
        $this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='".$otherclass."'  >PREV</a>&nbsp;";
        }
        
        $this->tbl.="</strong></td><td width='70%' class='blogDate'  align='right'>";
        /*if($simple!='N')
        {
        for($i=$start_loop;$i<$end_loop;$i++)
        {
        if($current_page==$i)
        {
        $this->tbl.="<strong><span class='".$selclass."'>".$i."</span></strong>&nbsp;&nbsp;";
        }
        else
        {
        $this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='".$otherclass."' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;";
        }
        }
        }
        
        if($start+$this->record_per_page<$totalrows)
        {
        $this->tbl.="</td><td width='15%' align='right'><strong>";
        $this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$NextPage."</a>";
        $this->tbl.="</strong></td></tr></table>";
        }
        else
        {
        $this->tbl.="</td>";
        $this->tbl.="</tr></table>";
        }*/
        $totpage = ceil($totalrows / $this->record_per_page);

        if ($totpage <= 5)
        {

            for ($i = 1;$i <= $totpage;$i++)
            {
                if ($i == $totpage)
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($i != $start)
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($i) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
                }
                else
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
                }
            }
        }
        else
        {
            $temp1 = 0;
            $temp = 0;
            $temp = $start - ($start % 5);

            if ($start % 5 == 0)
            {
                $temp = $start - 4;
            }
            else
            {
                $temp = $temp;
            }

            if ($start + 4 == $totpage)
            {
                $temp1 = $totpage;
            }
            else if ($start == "1")
            {
                $temp1 = $start + 5;
            }
            else
            {
                $temp1 = $start + 4;
            }

            for ($n = $start;$n < $temp1;$n++)
            {
                if ($n > $totpage) break;
                if ($n == ($temp1 - 1))
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($start == $n)
                {
                    if ($start > 1) $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n - 1) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . ($n - 1) . "</a>$blnkspace1";

                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $n . "</span></strong>$blnkspace1";
                    //$this->tbl.=$n."&nbsp;&nbsp;";
                    
                }
                else
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a>$blnkspace1";
                }
            }

        }

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }

    function number_pageing_runwaysub($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();

        if ($start > 1)
        {
            $newstart = ($start - 1) * $this->record_per_page;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        /*$total_pages=ceil($totalrows/$this->record_per_page);
        $current_page=($start+$this->record_per_page)/$this->record_per_page;
        $loop_counter=ceil($current_page/$this->pages);
        $start_loop=($loop_counter*$this->pages-$this->pages)+1;
        $end_loop=($this->pages*$loop_counter)+1;
        
        if($end_loop>$total_pages)
        $end_loop=$total_pages+1;*/

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='150' height='100%' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'><strong>";

        /*if($start>0)
        {
        $this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='".$otherclass."'  >PREV</a>&nbsp;";
        }
        
        $this->tbl.="</strong></td><td width='70%' class='blogDate'  align='right'>";
        /*if($simple!='N')
        {
        for($i=$start_loop;$i<$end_loop;$i++)
        {
        if($current_page==$i)
        {
        $this->tbl.="<strong><span class='".$selclass."'>".$i."</span></strong>&nbsp;&nbsp;";
        }
        else
        {
        $this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='".$otherclass."' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;";
        }
        }
        }
        
        if($start+$this->record_per_page<$totalrows)
        {
        $this->tbl.="</td><td width='15%' align='right'><strong>";
        $this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$NextPage."</a>";
        $this->tbl.="</strong></td></tr></table>";
        }
        else
        {
        $this->tbl.="</td>";
        $this->tbl.="</tr></table>";
        }*/
        $totpage = ceil($totalrows / $this->record_per_page);

        if ($totpage <= 5)
        {

            for ($i = 1;$i <= $totpage;$i++)
            {
                if ($i == $totpage)
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($i != $start)
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($i) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
                }
                else
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
                }
            }
        }
        else
        {
            $temp1 = 0;
            $temp = 0;
            $temp = $start - ($start % 5);

            if ($start % 5 == 0)
            {
                $temp = $start - 4;
            }
            else
            {
                $temp = $temp;
            }

            if ($start + 4 == $totpage)
            {
                $temp1 = $totpage;
            }
            else if ($start == "1")
            {
                $temp1 = $start + 5;
            }
            else
            {
                $temp1 = $start + 4;
            }

            for ($n = $start;$n < $temp1;$n++)
            {
                if ($n > $totpage) break;
                if ($n == ($temp1 - 1))
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($start == $n)
                {
                    if ($start > 1) $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n - 1) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . ($n - 1) . "</a>$blnkspace1";

                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $n . "</span></strong>$blnkspace1";
                    //$this->tbl.=$n."&nbsp;&nbsp;";
                    
                }
                else
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a>$blnkspace1";
                }
            }

        }

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }

    function number_pageing_dress_test2($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();

        if ($start > 1)
        {
            $newstart = ($start - 1) * $this->record_per_page;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='150' height='100%' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'><strong>";

        $totpage = ceil($totalrows / $this->record_per_page);

        if ($totpage <= 5)
        {

            for ($i = 1;$i <= $totpage;$i++)
            {
                if ($i == $totpage)
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($i != $start)
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($i) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
                }
                else
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
                }
            }
        }
        else
        {
            $temp1 = 0;
            $temp = 0;
            $temp = $start - ($start % 5);

            if ($start % 5 == 0)
            {
                $temp = $start - 4;
            }
            else
            {
                $temp = $temp;
            }

            if ($start + 4 == $totpage)
            {
                $temp1 = $totpage;
            }
            else if ($start == "1")
            {
                $temp1 = $start + 5;
            }
            else
            {
                $temp1 = $start + 4;
            }

            for ($n = $start;$n < $temp1;$n++)
            {
                if ($n > $totpage) break;
                if ($n == ($temp1 - 1))
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }

                if ($start == $n)
                {
                    if ($start > 1) $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n - 1) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . ($n - 1) . "</a>$blnkspace1";

                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $n . "</span></strong>$blnkspace1";
                    //$this->tbl.=$n."&nbsp;&nbsp;";
                    
                }
                else
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($n) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a>$blnkspace1";
                }
            }

        }

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }

    function number_pageing_dress_continue($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();

        if ($start > 1)
        {
            $newstart = ($start - 1) * $this->record_per_page;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&amp;" . $V . "=" . $K;
        }

        $this->tbl = "<table width='150' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'>";

        $totpage = ceil($totalrows / $this->record_per_page);

        //if($totpage <=5)
        //{
        for ($i = 1;$i <= $totpage;$i++)
        {
            if ($i == $totpage)
            {
                $blnkspace1 = "";
            }
            else
            {
                $blnkspace1 = "&nbsp;&nbsp;";
            }

            if ($i != $start)
            {
                $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($i) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
            }
            else
            {
                $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
            }
        }
        /*}
        else
        {
        $temp1=0;
        $temp=0;
        $temp=$start-($start%5);
        
        if($start%5==0)
        {
        $temp=$start-4;
        }
        else
        {
        $temp=$temp;
        }
        
        if($start+4==$totpage)
        {
        $temp1=$totpage;
        }
        else if($start=="1")
        {
        $temp1=$start+5;
        }
        else
        {
        $temp1=$start+4;
        }
        
        echo $temp1;
        for($n=1;$n<$temp1;$n++)
        {
        if($n>$totpage)
        break;
        if($n==($temp1-1))
        {
        $blnkspace1="";
        }
        else
        {
        $blnkspace1="&nbsp;&nbsp;";
        }
        
        if($start==$n)
        {
        //if($start>1)
        //	$this->tbl.="<a href='".$this->file_names."?start=".($n-1).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".($n-1)."</a>$blnkspace1";
        
        $this->tbl.="<strong><span class='".$selclass."'>".$n."</span></strong>$blnkspace1";
        //$this->tbl.=$n."&nbsp;&nbsp;";
        }
        else
        {
        $this->tbl.="<a href='".$this->file_names."?start=".($n).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$n."</a>$blnkspace1";
        }
        }
        
        }*/

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    function number_pageing_dress_continue_designer($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();

        if ($start > 1)
        {
            $newstart = ($start - 1) * $this->record_per_page;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        /*$tmpva="";
        foreach($_GET as $V=>$K)
        {
        if($V!="start")
        $tmpva.="&".$V."=".$K;
        }*/

        $this->tbl = "<table width='150' border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'>";

        $totpage = ceil($totalrows / $this->record_per_page);

        //if($totpage <=5)
        //{
        for ($i = 1;$i <= $totpage;$i++)
        {
            if ($i == $totpage)
            {
                $blnkspace1 = "";
            }
            else
            {
                $blnkspace1 = "&nbsp;&nbsp;";
            }

            if ($i != $start)
            {
                $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($i) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
            }
            else
            {
                $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
            }
        }
        /*}
        else
        {
        $temp1=0;
        $temp=0;
        $temp=$start-($start%5);
        
        if($start%5==0)
        {
        $temp=$start-4;
        }
        else
        {
        $temp=$temp;
        }
        
        if($start+4==$totpage)
        {
        $temp1=$totpage;
        }
        else if($start=="1")
        {
        $temp1=$start+5;
        }
        else
        {
        $temp1=$start+4;
        }
        
        echo $temp1;
        for($n=1;$n<$temp1;$n++)
        {
        if($n>$totpage)
        break;
        if($n==($temp1-1))
        {
        $blnkspace1="";
        }
        else
        {
        $blnkspace1="&nbsp;&nbsp;";
        }
        
        if($start==$n)
        {
        //if($start>1)
        //	$this->tbl.="<a href='".$this->file_names."?start=".($n-1).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".($n-1)."</a>$blnkspace1";
        
        $this->tbl.="<strong><span class='".$selclass."'>".$n."</span></strong>$blnkspace1";
        //$this->tbl.=$n."&nbsp;&nbsp;";
        }
        else
        {
        $this->tbl.="<a href='".$this->file_names."?start=".($n).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$n."</a>$blnkspace1";
        }
        }
        
        }*/

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    function number_pageing_dress_3box($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {
        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start2();
        if ($start > 1)
        {
            $newstart = $start;
        }
        else
        {
            $newstart = 0;
        }

        $order = $_GET['order'];
        echo $this->query .= " limit $newstart," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        /*$total_pages=ceil($totalrows/$this->record_per_page);
        $current_page=($start+$this->record_per_page)/$this->record_per_page;
        $loop_counter=ceil($current_page/$this->pages);
        $start_loop=($loop_counter*$this->pages-$this->pages)+1;
        $end_loop=($this->pages*$loop_counter)+1;
        
        if($end_loop>$total_pages)
        $end_loop=$total_pages+1;*/

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='150'  border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='150' align='right'>";

        /*if($start>0)
        {
        $this->tbl.="<a href='".$this->file_names."?start=".($start-$this->record_per_page).$tmpva."'  class='".$otherclass."'  >PREV</a>&nbsp;";
        }
        
        $this->tbl.="</strong></td><td width='70%' class='blogDate'  align='right'>";
        /*if($simple!='N')
        {
        for($i=$start_loop;$i<$end_loop;$i++)
        {
        if($current_page==$i)
        {
        $this->tbl.="<strong><span class='".$selclass."'>".$i."</span></strong>&nbsp;&nbsp;";
        }
        else
        {
        $this->tbl.="<strong><a href='".$this->file_names."?start=".($i-1)*$this->record_per_page.$tmpva."'  class='".$otherclass."' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$i."</a></strong>&nbsp;&nbsp;";
        }
        }
        }
        
        if($start+$this->record_per_page<$totalrows)
        {
        $this->tbl.="</td><td width='15%' align='right'><strong>";
        $this->tbl.="<a href='".$this->file_names."?start=".($start+$this->record_per_page).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".$NextPage."</a>";
        $this->tbl.="</strong></td></tr></table>";
        }
        else
        {
        $this->tbl.="</td>";
        $this->tbl.="</tr></table>";
        }*/
        $totpage = ceil($totalrows / $this->record_per_page);

        if ($totpage <= 5)
        {
            for ($i = 1;$i <= $totpage;$i++)
            {
                if ($i == $totpage)
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }
                if ($start == 1)
                {
                    $fff = 1;
                }
                else if ($start == "7")
                {
                    $fff = 2;
                }
                else
                {
                    $fff = ($start / 7) + 1;
                }

                if ($i == $fff)
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>$blnkspace1";
                }
                else
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . (($i - 1) * 7) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a>$blnkspace1";
                }
            }
        }
        else
        {

            $temp1 = 0;
            $temp = 0;
            //echo "<br>BEFOR ".$start;
            if ($start == "7")
            {
                $start = 2;
            }
            if ($start != "1" && $start != "7")
            {
                $start = ceil($start / 7);
            }

            //echo "<br>INNNNNNNNNNNNnnnnnn";
            /*$temp=$start-($start%5);
            
            if($start%5==0)
            {
            $temp=$start-4;
            }
            else
            {
            $temp=$temp;
            }*/
            //echo "NNNN>".$start;
            if (($start * 7) + 5 == $totpage)
            {
                $temp1 = $totpage;
            }
            else if ($start == "0")
            {
                $temp1 = $start + 5;
            }
            else
            {
                $temp1 = $start + 4;
            }
            //echo "<br>start= ".$start."<br>" ;
            //echo "Temp1= ".$temp1 ;
            for ($n = ($start);$n <= $temp1;$n++)
            {
                //echo "<br>".$n." => ".$temp1;
                if ($n > $totpage) break;
                if ($n == ($temp1))
                {
                    $blnkspace1 = "";
                }
                else
                {
                    $blnkspace1 = "&nbsp;&nbsp;";
                }
                //echo "<br>S=".$start;
                //echo "<br>N=".$n;
                if ($start == "1")
                {
                    $Chk = $start;
                }
                else
                {
                    $Chk = $start + 1;
                }

                if (($Chk) == ($n))
                {
                    /*if($start>1)
                    {
                    $this->tbl.="<a href='".$this->file_names."?start=".(($n-1)*7).$tmpva."' class='".$otherclass."' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">".($n-1)."</a>$blnkspace1";
                    }
                    else
                    {*/
                    //$this->tbl.="<strong><span class='".$selclass."'>".$n."</span></strong>$blnkspace1";
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . (($n - 1) * 7) . $tmpva . "' class='" . $selclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a>$blnkspace1";
                    //}
                    //$this->tbl.=$n."&nbsp;&nbsp;";
                    
                }
                else
                {
                    $this->tbl .= "<a href='" . $this->file_names . "?start=" . (($n - 1) * 7) . $tmpva . "' class='" . $otherclass . "' onmouseover=\"smsg('Next Page11');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a>$blnkspace1";
                }
            }

        }

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    function number_pageing_newarrival($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $color, $NextPage)
    {

        $this->file_names();
        $this->query = $query;
        if ($color == "white")
        {
            $selclass = "arial10-white";
            $otherclass = "arial10-link-wt";
        }
        if ($color == "black")
        {
            $selclass = "arial11-black2";
            $otherclass = "arial11-link";
        }
        if ($NextPage == "NEXT")
        {
            $NextPage = "NEXT";
        }
        if ($NextPage == "PAGE")
        {
            $NextPage = "PAGE";
        }

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start();

        $order = $_GET['order'];
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->tbl = "<table width='100%'  border='0' cellpadding='0' cellspacing='0' align='right' ><tr><td width='15%' align='left'>";

        if ($start > 0)
        {
            $this->tbl .= "<a href='" . $this->file_names . "?start=" . ($start - $this->record_per_page) . $tmpva . "'  class='" . $otherclass . "'  >PREV</a>&nbsp;";
        }

        $this->tbl .= "</strong></td><td width='70%' class='blogDate'  align='right'>";
        /*		if($detail!="N" and $simple !="N")
        $this->tbl.="<strong>Result ".($start+1)." - ".($start+$total)." of ".$totalrows." Records</strong><BR>";
        */
        if ($total_pages <= 3)
        {
            for ($i = $start_loop;$i < $end_loop;$i++)
            {
                if ($current_page == $i)
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $i . "</span></strong>&nbsp;&nbsp;";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start=" . ($i - 1) * $this->record_per_page . $tmpva . "'  class='" . $otherclass . "' onmouseover=\"smsg('View Page Number $i');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $i . "</a></strong>&nbsp;&nbsp;";
                }
            }
        }
        else
        {
            $temp1 = 0;
            $temp = 0;
            $temp = $start - ($start % 3);

            if ($start % 3 == 0)
            {
                $temp = $start - 2;
            }
            else
            {
                $temp = $temp + 1;
            }

            if ($start + 3 == $total_pages)
            {
                $temp1 = $total_pages;
            }
            else
            {
                $temp1 = $start + 2;
            }
            for ($n = $start;$n <= $temp1;$n++)
            {
                if ($n > $total_pages) break;
                if ($start == $n)
                {
                    $this->tbl .= "<strong><span class='" . $selclass . "'>" . $n . "</span></strong>&nbsp;&nbsp;";
                }
                else
                {
                    $this->tbl .= "<strong><a href='" . $this->file_names . "?start=" . ($n - 1) * $this->record_per_page . $tmpva . "'  class='" . $otherclass . "' onmouseover=\"smsg('View Page Number $n');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . $n . "</a></strong>&nbsp;&nbsp;";
                }
            }
        }

        $this->tbl .= "</td>";
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }

    function number_pageing_bottom_profilecontacts_sub($query, $record_per_page = '', $pages = '', $detail = '', $bottom = '', $simple = '', $pagename)
    {

        $this->file_names();
        $this->query = $query;

        if ($record_per_page > 0) $this->record_per_page = $record_per_page;

        if ($pages > 0) $this->pages = $pages;

        $result = $this->runquery($this->query);
        $totalrows = mysql_affected_rows();

        $start = $this->start();

        $order = $_GET['order'];
        $this->query .= " limit $start," . $this->record_per_page;
        $result = $this->runquery($this->query);
        $total = mysql_affected_rows();

        $total_pages = ceil($totalrows / $this->record_per_page);
        $current_page = ($start + $this->record_per_page) / $this->record_per_page;
        $loop_counter = ceil($current_page / $this->pages);
        $start_loop = ($loop_counter * $this->pages - $this->pages) + 1;
        $end_loop = ($this->pages * $loop_counter) + 1;

        if ($end_loop > $total_pages) $end_loop = $total_pages + 1;

        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        if ($pagename != "")
        {
            $pagenametitle = $pagename;
        }
        else
        {
            $pagenametitle = "Contacts";
        }

        $this->tbl = "<table align='left'  border='0' cellspacing='2' cellpadding='5' width='100%'><tr>";
        $this->tbl .= "<td width='200' align='left' valign='middle'><strong>" . ($start + 1) . " - " . ($start + $total) . " of " . $totalrows . " " . $pagenametitle . "</strong></td>";
        if ($start > 0)
        {
            $this->tbl .= "<td width='85' align='right' valign='middle'><a href='" . $this->file_names . "?start=" . ($start - $this->record_per_page) . $tmpva . "' ><img src='images/prev-btn.jpg' border='0' alt='Previous'/></a></td>";
        }

        if ($start + $this->record_per_page < $totalrows)
        {
            $this->tbl .= "<td width='80%' align='right' valign='middle'><a href='" . $this->file_names . "?start=" . ($start + $this->record_per_page) . $tmpva . "' ><img src='images/next-btn.png' border='0' alt='Next'/ align='right'></a></td>";
        }
        $this->tbl .= "</tr></table>";

        if ($bottom == "Y")
        {
            if ($totalrows > 0) return $result = array(
                $result,
                $this->tbl
            );
            else return $result = array(
                $result,
                ""
            );
        }
        else
        {
            if ($totalrows > 0)
            {
                echo $this->tbl;
                return $result;
            }
            else
            {
                return $result;
            }
        }

    }
    ///////////////End by yogesh//////////////
    

    //////////////  SIMPLE NEXT-PRI PAGING ///////////////////CREATED BY
    function pageing($query, $record_per_page = "", $pages = "")
    {
        return $this->number_pageing($query, $record_per_page, $pages, '', '', 'N');
    }
    //////////////  END OF SIMPLE PAGING FUNCTION///////////////////CREATED BY
    //////////////  WRITE ALL,A TO Z CHARACTER WITH CURRENT PAGE LINK ///////////////////CREATED BY
    function order()
    {
        $this->file_names();
        $this->order .= "<TR><TD><a href='" . $this->file_names . "' onmouseover=\"smsg('View All Records');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">All</a></TD><TD >|</TD>";
        for ($i = 65;$i < 91;$i++)
        {
            $this->order .= "<TD><a class=la href='$file_names?order=" . chr($i) . "' onmouseover=\"smsg('View By " . chr($i) . "');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">" . chr($i) . "</a></TD><TD class=lg>|</TD>";
        }
        return $this->order .= "</TR>";
    }
    function orderFront($classname, $seperation)
    {
        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "order" && $V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->file_names();
        //$this->order.="<tr><td><a href='".$this->file_names."'>All</a></TD><TD >|</TD>";
        for ($i = 65;$i < 91;$i++)
        {
            $this->orderFront .= "<a class=" . $classname . " href='$file_names?order=" . chr($i) . "$tmpva'>" . chr($i) . "</a>" . $seperation . "";
        }
        //return $this->orderFront.="</tr>";
        return $this->orderFront;
    }
    function orderFront2($classname, $seperation)
    {
        $tmpva = "";
        foreach ($_GET as $V => $K)
        {
            if ($V != "order" && $V != "start") $tmpva .= "&" . $V . "=" . $K;
        }

        $this->file_names();
        //$this->order.="<tr><td><a href='".$this->file_names."'>All</a></TD><TD >|</TD>";
        for ($i = 65;$i < 91;$i++)
        {
            $this->orderFront2 .= "<a class=" . $classname . " href='$file_names?order=" . chr($i) . "$tmpva'>" . chr($i) . "</a>" . $seperation . "";
        }
        //return $this->orderFront.="</tr>";
        return $this->orderFront2;
    }
    function MakeCombo($query, $value = "", $fill_value, $comboname, $selected = "")
    {
        if ($value == "") $value = $fill_value;
        $run = $this->runquery($query);
        $totlist = mysql_affected_rows();
        $Combo = "<select name='$comboname'>";
        $Combo .= "<option value=''>-----Select-----</option>";
        for ($i = 0;$i < $totlist;$i++)
        {
            $get = mysql_fetch_object($run);
            $Combo .= "<option value='" . $get->$value . "'";
            if ($selected == $get->$value)
            {
                $Combo .= "selected='selected'";
            }
            $Combo .= ">" . $get->$fill_value . "</option>";
        }
        $Combo .= "</select>";
        echo $Combo;
    }
}

$prs_pageing = new get_pageing;

function run($query)
{
    return mysql_query($query);
}

function addlink($title, $file, $class = "")
{
    $str = "<a href='$file'";
    $str .= (strlen($class) > 0) ? " class='$class'" : "";
    $str .= " onmouseover=\"smsg('$title');return document.prs_return\" onmouseout=\"nosmsg('Done');return document.prs_return\">$title</a>";
    echo $str;
}

function CountryCombo($query = "", $value = "", $fill_value = "", $combo_name = "", $selected = "")
{
    if ($query == "") $query = "select * from country order by `plid` asc, `name` asc";
    if ($fill_value == "") $fill_value = "name";
    if ($value == "") $value = $fill_value;
    if ($combo_name == "") $combo_name = "country";
    $prs_pageing = new get_pageing;
    $prs_pageing->MakeCombo($query, $value, $fill_value, $combo_name, $selected);
}
function ads($str)
{
    return $newstr = htmlentities($str, ENT_QUOTES);
}
function rms($str)
{
    return $newstr = stripslashes($str);
}
//////////////  END OF ORDER FUNCTION///////////////////CREATED BY
function getimage($nm, $mywidth, $myheight, $text = "")
{
    echo "sample.php?nm=$nm&mwidth=$mywidth&mheight=$myheight&text=$text";
}

function getuser($condition = "", $return_true, $return_false = "", $tbl = "")
{
    if ($condition == "") $condition = "id=" . $_COOKIE["UID"];

    if ($tbl == "") $seluser = "select * from users";
    else $seluser = "select * from $tbl";

    $seluser .= " where $condition";
    $runuser = run($seluser);
    echo mysql_error();
    $totuser = mysql_affected_rows();
    if ($totuser > 0)
    {
        $getuser = mysql_fetch_object($runuser);
        return $getuser->$return_true;
    }
    else
    {
        if ($return_false == "") return 0;
        else return $return_false;
    }
}

function getvalue($tbl, $condition = "", $return_true, $return_false = "")
{
    $values = getuser($condition, $return_true, $return_false, $tbl);
    return $values;
}

function GetReplyCount($Bid)
{
    $BrSql = mysql_query("SELECT * FROM blog_reply WHERE blog_post_id='" . $Bid . "'");
    $BrTot = mysql_num_rows($BrSql);

    return $BrTot;
}

function GetGroupMember($Uid)
{
    $GrpId = "";

    $S1 = mysql_query("SELECT to_userid FROM blog_invite WHERE from_userid=" . $Uid . "");

    if ($S1)
    {
        while ($R1 = mysql_fetch_object($S1))
        {
            if ($GrpId == "") $GrpId = $R1->to_userid;
            else $GrpId = $GrpId . "," . $R1->to_userid;
        }
    }

    $S2 = mysql_query("SELECT from_userid FROM blog_invite WHERE to_userid='" . $Uid . "'");
    if ($S2)
    {
        while ($R2 = mysql_fetch_object($S2))
        {
            if ($GrpId == "") $GrpId = $R2->from_userid;
            else $GrpId = $GrpId . "," . $R2->from_userid;
        }
    }
    return $GrpId;
}
function getvar()
{
    $sel = "select * from affiliate where id=" . $_COOKIE["AID"];
    $run = mysql_query($sel);
}

?>
